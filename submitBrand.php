<?php
include 'temp1.php';
$role = $_SESSION['role'];
if ($role != 'admin') {
?>
    <meta http-equiv="refresh" content="1;url=http://localhost/learn%20php/Project/Website/dashboard.php">
<?php
    die;
}



?>

<head>
    <meta charset="UTF-8">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;800&family=Raleway:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,800&display=swap" rel="stylesheet">
    <title>Website</title>

    <style>
        .update {
            width: 84%;
            height: 100%;
            margin-left: 15%;
            margin-top: -40%;
        }

        /* Style for the form inputs */
        .form-control {
            width: 50%;
            padding: 0.2rem 0.rem;
            font-size: 0.8rem;
        }

        #login {
            margin-bottom: 60%;
        }

        /* New CSS to align the form to the right */
        .login-form {
            background-color: #e1e1e1;
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            height: 60%;
            margin-left: 22%;
            margin-top: -18%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .login-heading {
            text-align: center;
            font-size: 30px;
            margin-bottom: 20px;
            color: black;
            font-weight: bold;
        }

        .form-label {
            margin-right: 60%;
            color: black;
            font-weight: 100;
            font-weight: bold;
            /* Adjust the margin to your preference */
        }

        .mb-1 {
            margin-left: 35%;
            width: 70%;
            height: 50%;
        }

        #btn {
            margin-left: 35%;
            width: 33%;
            font-weight: bold;
        }
    </style>
</head>


<?php

include 'productdatabase.php';

if (isset($_POST['addBrand'])) {
    $subCategoryId = $_POST["subCategoryId"];
    $brand=$_POST["brand"];
    $description = $_POST["description"];
 

    $query = "INSERT INTO brands (sub_category_id, brand, description) 
    VALUES ('$subCategoryId', ' $brand', '$description')";

    $result = mysqli_query($conn, $query);
    if ($result) {

?>
        <meta http-equiv="refresh" content="1;url=http://localhost/learn%20php/Project/Website/brandDisplay.php">
<?php
    } else {
        echo "Error";
    }
}
?>

<body>
    <div class='update d-flex align-items-center'>
        <div class="login-form">
            <div class="login-heading">Add Brand</div>
            <form method="post" enctype="multipart/form-data">
                <div class="mb-1">
                    <label for="category" class="form-label">Sub Category</label>
                        <select name="subCategoryId">
                        <option value="">Sub Category</option>
                       <?php
                            include'productdatabase.php';
                            $getSubCategory="SELECT * FROM sub_category";
                            $getSubCategoryresult=mysqli_query($conn,$getSubCategory);
                            while ($row = $getSubCategoryresult->fetch_assoc()) {
                                ?>
                                 <option value="<?php echo $row['id']?>"><?php echo $row['sub_category']?></option> 
                            <?php
                                }
                            ?>
                        </select>
                </div>
                <div class="mb-1">
                    <label for="brand" class="form-label">Brand</label>
                    <input type="text" class="form-control form-control-sm" id="subcategory" name="brand" aria-describedby="brand" value="">
                </div>
                <div class="mb-1">
                    <label for="description" class="form-label">Description:</label>
                    <input type="textarea" id="description" name="description" placeholder="Enter a description">
                </div>
                <div>
                    <button type="submit" name="addBrand" class="btn btn-success" id="btn">Add Brand
                    </button>
                </div>
            </form>

        </div>
    </div>









    <?php
    include 'temp2.php';
    ?>