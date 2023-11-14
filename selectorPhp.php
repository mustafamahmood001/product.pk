<?php
include 'productdatabase.php';

if (isset($_POST['catId'])) { 
    $id = $_POST['catId'];

    $query = "select * from sub_category where category_id='$id'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['id'];
        $sub_category = $row['sub_category'];
        echo "<option value='$id'>$sub_category</option>";
    }
}

if (isset($_POST['subCategoryId'])) {
    $subCategoryId = $_POST['subCategoryId'];

    $query = "select * from brands where sub_category_id='$subCategoryId'";
    $results = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($results)) {
        $id = $row['id'];
        $brand = $row['brand'];
        echo "<option value='$id'>$brand</option>";
    }
}

?>
