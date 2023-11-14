<?php
session_start();

include'productdatabase.php';

$role=$_SESSION['role'];
if ($role != 'admin') {
    ?>
    <meta http-equiv="refresh" content="1;url=http://localhost/learn%20php/Project/Website/dashboard.php">
<?php   
 die;
}


$id=$_GET['id'];
$query="Delete from signup where id='$id'";
$result=mysqli_query($conn,$query);

if($result){
    $_SESSION['flash_message']="Deleted successfully";
    header("Location: userdata.php");
}

else{
    echo"Not deleted";
}




?>