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
    .container {
        margin-top: 8%;
    }

    #search {
        width: 22%;
        margin-left: 78%;
        margin-top: -13%;
    }

    .pagination-button {
        display: inline-block;
        padding: 5px 10px;
        margin: 3px;
        background-color: #007bff;
        color: #fff;
        border: 1px solid #007bff;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .pagination-button:hover {
        background-color: #0056b3;
    }

    #paging {
        margin-left: 50%;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .table-wrapper table {
        width: 200%;
        table-layout: fixed;
    }

    .table-wrapper table td {
        width: 50%;
    }

    .table-wrapper table th {
        width: 50%;
    }
</style>
<?php
if (isset($_SESSION["flash_message"])) {
    $message = $_SESSION["flash_message"];
    unset($_SESSION["flash_message"]);
    echo "<div class='alert alert-success'>$message</div>";
}
?>
<div class="content">
    <div class="container" style="margin-top: -2%;">
        <form method="post">
            <div id="control">
                <div class="table-wrapper">
                    <table id="example" class="table table-striped table-bordered" style="width:100%; ">
                        <thead class="thead-dark" style="text-align:center">
                            <tr>
                                <th>Id</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Brand</th>
                                <th>Condition</th>
                                <th>Assembly</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Color</th>
                                <th>Seller Name</th>
                                <th>Mobile Number</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Description</th>
                                <th>Images</th>
                                <th>IS Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody style="text-align:center">
                            <?php
                          $user_id=$_SESSION["id"];
                        
                          
                          include 'productdatabase.php';

                            $sql = "SELECT add_post.*, category.category, sub_category.sub_category, brands.brand
                                    FROM add_post
                                    LEFT JOIN category ON add_post.category = category.id
                                    LEFT JOIN sub_category ON add_post.sub_category = sub_category.id
                                    LEFT JOIN brands ON add_post.brand = brands.id 
                                    WHERE    user_id =  $user_id"; 


                            
                            $result = mysqli_query($conn, $sql);

                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['product_name'] . "</td>";
                                echo "<td>" . $row['category'] . "</td>";
                                echo "<td>" . $row['sub_category'] . "</td>";
                                echo "<td>" . $row['brand'] . "</td>";
                                echo "<td>" . $row['condition'] . "</td>";
                                echo "<td>" . $row['assembly'] . "</td>";
                                echo "<td>" . $row['price'] . "</td>";
                                echo "<td>" . $row['quantity'] . "</td>";
                                echo "<td>" . $row['color'] . "</td>";
                                echo "<td>" . $row['seller_name'] . "</td>";
                                echo "<td>" . $row['mobile_number'] . "</td>";
                                echo "<td>" . $row['address'] . "</td>";
                                echo "<td>" . $row['description'] . "</td>";
                                echo "<td>" . $row['status'] . "</td>";
                                $imageNames = explode(',', $row['image']);
                                echo "<td>";
                                foreach ($imageNames as $imageName) {
                                    echo "<img src='addImage/$imageName' alt='product_image' style='width:70px; height:70px;'>";
                                }
                                echo "</td>";
                                $is_active = $row['is_active'];
                                if ($is_active == 1) {
                                    echo "<td align='center' style='border:none'>
                                        <a style='margin:3px' href='approvedAdd.php?id=" . $row["id"] . "' class='btn btn-success' data-placement='top' onclick='return confirmUpdate();' >
                                        <i class='bi bi-check-lg'></i>
                                    </a>
                                    </td>";
                                } else {
                                    echo "<td align='center' style='border:none'>
                                    <a style='margin:1px' href='approvedAdd.php?id=" . $row["id"] . "' class='btn btn-warning' onclick='return confirmDelete()';>
                                    <i class='bi bi-backspace-reverse'></i>
                                    </a>
                                    </td>";
                                }
                                echo "<td align='center' style='border:none'>
                                    <a style='margin:3px' href='addUpdate.php?id=" . $row["id"] . "' class='btn btn-primary' data-placement='top' onclick='return confirmUpdate();' >
                                        <i class='fas fa-pencil-alt'></i>
                                    </a>
                                    <a style='margin:1px' href='addDelete.php?id=" . $row["id"] . "' class='btn btn-danger' onclick='return confirmDelete()';>
                                        <i class='fas fa-trash'></i>
                                    </a>
                                </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </form>
    </div>
</div>



<?php
include 'temp2.php';
?>
