<?php
session_start();

include'productdatabase.php';


$id=$_GET['id'];
$query="Delete * from sub_category where id='$id'";
$result=mysqli_query($conn,$query);

if($result){
    $_SESSION['flash_message']="Deleted successfully";
    ?>
    
    <meta http-equiv="refresh" content="1;url=http://localhost/learn%20php/Project/Website/subCategoryDisplay.php">
    <?php
}
else{
    echo"Not deleted";
}




?>