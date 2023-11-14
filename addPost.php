<?php
include 'temp1.php';
$role = $_SESSION['role'];
if ($role != 'user') {
?>
    <meta http-equiv="refresh" content="1;url=http://localhost/learn%20php/Project/Website/dashboard.php">
<?php
    die;
}


?>

<style>
    #add {
        width: 85%;
        height: 96%;
        border: solid 3px blue;
        margin-top: -45%;
        margin-left: 15%;
        background-color: #f7f8f8;
    }

    .error_message {
        color: red;
    }
</style>

<?php

$productNameErr = $categorySelectErr = $subCategorySelectErr = $brandErr = $conditionErr = $assemblyErr = $priceErr = $quantityErr = $colorErr = $sellerNameErr = $mobileNumberErr = $addressErr = $productDescriptionErr = $photoErr = "";

include 'productdatabase.php';


if (isset($_POST["submitAdd"])) {

    $_SESSION["id"];
    $user_id = $_SESSION["id"];

    $productName = isset($_POST["productName"]) ? $_POST["productName"] : "";
    $categorySelect = isset($_POST["categorySelect"]) ? $_POST["categorySelect"] : "";
    $subCategorySelect = isset($_POST["subCategorySelect"]) ? $_POST["subCategorySelect"] : "";
    $brand = isset($_POST["brand"]) ? $_POST["brand"] : "";
    $condition = isset($_POST["condition"]) ? $_POST["condition"] : "";
    $assembly = isset($_POST["assembly"]) ? $_POST["assembly"] : "";
    $price = isset($_POST["price"]) ? $_POST["price"] : "";
    $quantity = isset($_POST["quantity"]) ? $_POST["quantity"] : "";
    $color = isset($_POST["color"]) ? $_POST["color"] : "";
    $sellerName = isset($_POST["sellerName"]) ? $_POST["sellerName"] : "";
    $mobileNumber = isset($_POST["mobileNumber"]) ? $_POST["mobileNumber"] : "";
    $address = isset($_POST["address"]) ? $_POST["address"] : "";
    $productDescription = isset($_POST["productDescription"]) ? $_POST["productDescription"] : "";
    $status = $_POST['status'];
    

    // Check if at least one file was selected
    if (isset($_FILES['photo']['name']) && is_array($_FILES['photo']['name'])) {
        $photo = array();
        $target_dir = "addImage/";
        $photoErr = array(); // Create an array to store individual image error messages

        for ($i = 0; $i < count($_FILES['photo']['name']); $i++) {
            $file_name = $_FILES['photo']['name'][$i];
            $target_file = $target_dir . basename($file_name);
            $photoFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if ($_FILES["photo"]["size"][$i] > 500000) {
                $photoErr[$i] = "Sorry, your file is too large.";
            } elseif (!in_array($photoFileType, array("jpg", "png", "jpeg", "gif"))) {
                $photoErr[$i] = "Only JPG, JPEG, PNG, and GIF files allowed.";
            }

            if (empty($photoErr[$i])) {
                // If no error, move the file
                move_uploaded_file($_FILES["photo"]["tmp_name"][$i], $target_file);
                $photo[] = $file_name;
            }
        }
    } else {
        $photoErr = "Please Upload at least one image";
    }


    // Validations
    if (empty($productName)) {
        $productNameErr = "Product Name is required";
    } elseif (strlen($productName) > 10) {
        $productNameErr = "Name should not be longer than 10 characters.";
    }


    if (empty($categorySelect)) {
        $categorySelectErr = "Category is required";
    }

    if (empty($subCategorySelect)) {
        $subCategorySelectErr = "Sub Category is required";
    }

    if (empty($brand)) {
        $brandErr = "Brand is required";
    }

    if (empty($condition)) {
        $conditionErr = "Condition is required";
    }

    if (empty($assembly)) {
        $assemblyErr = "Assembly is required";
    }

    if (empty($price)) {
        $priceErr = "Price is required";
    }

    if (empty($quantity)) {
        $quantityErr = "Quantity is required";
    }

    if (empty($color)) {
        $colorErr = "Color is required";
    } elseif (!preg_match('/^[A-Za-z\s]+$/', $color)) {
        $colorErr = "Color must contain only alphabets and spaces.";
    } elseif (!in_array(strtolower($color), array("red", "blue", "green", "yellow", "other_valid_colors"))) {
        $colorErr = "Invalid color. Please choose from a valid color list.";
    }

    if (empty($sellerName)) {
        $sellerNameErr = "Seller Name is required";
    } elseif (!preg_match('/^[A-Za-z\s]+$/', $sellerName)) {
        $sellerNameErr = "Seller Name must contain only alphabets and spaces.";
    }

    if (empty($mobileNumber)) {
        $mobileNumberErr = "Mobile Number is required";
    } elseif (!preg_match('/^[0-9]{11}$/', $mobileNumber)) {
        $mobileNumberErr = "Mobile Number must be exactly 11 digits and contain only numbers.";
    }


    if (empty($address)) {
        $addressErr = "Address is required";
    }

    if (empty($productDescription)) {
        $productDescriptionErr = "Description is required";
    }

    if (empty($productNameErr) && empty($categorySelectErr) && empty($subCategorySelectErr) && empty($brandErr) && empty($conditionErr) && empty($assemblyErr) && empty($priceErr) && empty($quantityErr) && empty($colorErr) && empty($sellerNameErr) && empty($mobileNumberErr) && empty($addressErr) && empty($productDescriptionErr) && empty($photoErr)) {

        // Insert data into the database (as you had it before)
        $query = "INSERT INTO add_post (product_name, category, sub_category, brand, `condition`, assembly, price, quantity, color, seller_name, mobile_number, address, description,  user_id, status, image) 
            VALUES ('$productName', '$categorySelect', '$subCategorySelect', '$brand', '$condition', '$assembly', '$price', '$quantity', '$color', '$sellerName', '$mobileNumber', '$address', '$productDescription',  '$user_id','$status', '" . implode(",", $photo) . "')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['flash_message'] = "Submit Add Successfully";
?>
            <meta http-equiv="refresh" content="1;url=http://localhost/learn%20php/Project/Website/addDisplay.php">
<?php
        } else {
            echo "error";
        }
    }
}



?>





<div id="add">
    <form method="POST" enctype="multipart/form-data">
        <div id="addPost">
            <div class="row" style="margin-top: 1%;">
                <div class="col-md-4">
                    <div class="form-outline">
                        <label class="form-label" for="productName" style="font-size: 22px;">Product Name *</label>
                        <input type="text" name="productName" id="productName" class="form-control form-control-lg" style="width: 96%;" placeholder="Enter your product name" />
                    </div>
                    <div id="productName-error" class="error_message">
                        <?php echo $productNameErr; ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-outline">
                        <label class="form-label" for="categorySelect" style="font-size: 22px;">Category *</label>
                        <select name="categorySelect" id="categorySelect" class="form-control form-control-lg" style="width: 96%;">
                            <option value="" disabled selected>Select Category</option>
                            <?php
                            include 'productdatabase.php';
                            $getCategory = "SELECT * FROM category";
                            $getCategoryresult = mysqli_query($conn, $getCategory);
                            while ($row = $getCategoryresult->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['category'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div id="categorySelect-error" class="error_message">
                        <?php echo $categorySelectErr; ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-outline">
                        <label class="form-label" for="subCategorySelect" style="font-size: 22px;">Sub Category *</label>
                        <select name="subCategorySelect" id="subCategorySelect" class="form-control form-control-lg" style="width: 96%;">
                            <option value="" disabled selected>Select Sub Category</option>
                        </select>
                    </div>
                    <!-- Error message div for subCategorySelect inside the containing div -->
                    <div id="subCategorySelect-error" class="error_message">
                        <?php echo $subCategorySelectErr; ?>
                    </div>
                </div>
            </div>

        </div>
        <div class="row" style="margin-top: 1%;">
            <div class="col-md-4">
                <div class="form-outline">
                    <label class="form-label" for="brand" style="font-size: 22px;">Brand *</label>
                    <select name="brand" id="brand" class="form-control form-control-lg" style="width: 96%;">
                        <option value="" disabled selected>Select Brand </option>
                    </select>
                </div>
                <div id="brand-error" class="error_message">
                    <?php echo $brandErr; ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-outline">
                    <label class="form-label" for="condition" style="font-size: 22px;">Condition *</label>
                    <select name="condition" class="form-control form-control-lg" style="width: 96%">
                        <option value="" disabled selected>Select condition</option>
                        <option value="New">New</option>
                        <option value="Used">Used</option>
                    </select>
                </div>
                <div id="condition-error" class="error_message">
                    <?php echo $conditionErr; ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-outline">
                    <label class="form-label" for="assembly" style="font-size: 22px;">Assembly *</label>
                    <select name="assembly" class="form-control form-control-lg" style="width: 96%;">
                        <option value="" disabled selected>Select Assembly</option>
                        <option value="Imported">Imported</option>
                        <option value="Local">Local</option>
                    </select>
                </div>
                <div id="assembly-error" class="error_message">
                    <?php echo $assemblyErr; ?>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 1%;">
            <div class="col-md-4">
                <div class="form-outline">
                    <label class="form-label" for="price" style="font-size: 22px;">Price *</label>
                    <input type="number" name="price" class="form-control form-control-lg" style="width: 96%" placeholder="Enter the price" />
                </div>
                <div id="price-error" class="error_message">
                    <?php echo $priceErr; ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-outline">
                    <label class="form-label" for="quantity" style="font-size: 22px;">Quantity *</label>
                    <input type="number" name="quantity" class="form-control form-control-lg" style="width: 96%" placeholder="Enter the quantity" />
                </div>
                <div id="quantity-error" class="error_message">
                    <?php echo $quantityErr; ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-outline">
                    <label class="form-label" for="color" style="font-size: 22px;">Color *</label>
                    <input type="text" name="color" class="form-control form-control-lg" style="width: 96%" placeholder="Enter the color" />
                </div>
                <div id="color-error" class="error_message">
                    <?php echo $colorErr; ?>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 1%;">
            <div class="col-md-4">
                <div class="form-outline">
                    <label class="form-label" for="sellerName" style="font-size: 22px;">Seller Name *</label>
                    <input type="text" name="sellerName" class="form-control form-control-lg" style="width: 96%;" placeholder="Enter your name" />
                </div>
                <div id="sellerName-error" class="error_message">
                    <?php echo $sellerNameErr; ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-outline">
                    <label class="form-label" for="mobileNumber" style="font-size: 22px;">Mobile Number *</label>
                    <input type="number" name="mobileNumber" class="form-control" style="width: 96%;" placeholder="Enter your mobile number" />
                </div>
                <div id="mobileNumber-error" class="error_message">
                    <?php echo $mobileNumberErr; ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-outline">
                    <label class="form-label" for="address" style="font-size: 22px;">Address *</label>
                    <input type="text" name="address" class="form-control form-control-lg" style="width: 96%;" placeholder="Enter your address" />
                </div>
                <div id="address-error" class="error_message">
                    <?php echo $addressErr; ?>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 1%;">
            <div class="col-md-4">
                <div class="form-outline">
                    <div id="productDescription-error" class="error_message">
                        <?php echo $productDescriptionErr; ?>
                    </div>
                    <label class="form-label" for="productDescription" style="font-size: 22px;">Description *</label>
                    <textarea name="productDescription" class="form-control" rows="4" style="width: 96%;" placeholder="Write the description of your product"></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-outline">
                    <div id="photo-error" class="error_message">
                        <?php
                        if (is_array($photoErr)) {
                            foreach ($photoErr as $error) {
                                echo $error . "<br>";
                            }
                        } else {
                            echo $photoErr;
                        }
                        ?>
                    </div>
                    <label class="form-label" for="photo" style="font-size: 22px;">Upload Images *</label>
                    <input type="file" name="photo[]" class="form-control" style="width: 80%;" multiple />
                </div>

                <div class="col-md-4">
                    <input type="hidden" name="status" value="pending">
                    <button type="submit" class="btn btn-success" id="submitButton" name="submitAdd" style="width: 95%; height:55px; margin-top:20%; margin-left:100%">Submit Add</button>
                </div>
            </div>
        </div>
    </form>
</div>



<?php
include 'temp2.php';
?>

<!-- ... Your HTML form ... -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#categorySelect").on('change', function() {
            var categoryId = $(this).val();
            $.ajax({
                method: "POST",
                url: "selectorPhp.php",
                data: {
                    catId: categoryId
                },
                dataType: "html",
                success: function(data) {
                    $("#subCategorySelect").html(data);
                }
            });
        });

        $("#subCategorySelect").on('change', function() {
            var subCategoryId = $(this).val();
            $.ajax({
                method: "POST",
                url: "selectorPhp.php",
                data: {
                    subCategoryId: subCategoryId
                }, // Change this to "subCategoryId"
                dataType: "html",
                success: function(data) {
                    $("#brand").html(data); // Change this to match your HTML element ID
                }
            });
        });
    });
</script>

<?php
include 'temp2.php';
?>