<?php

$servername="localhost";
$username="root";
$passward="";
$dbname="product";

$conn=mysqli_connect($servername,$username,$passward,$dbname);

if($conn){
    // echo"Success";
}
else{
    echo"Error";
}






?>