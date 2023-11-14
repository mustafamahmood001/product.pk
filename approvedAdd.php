<?php
include'productdatabase.php';


if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    $sql = "SELECT is_active FROM add_post WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $is_active = $row['is_active'];
        
        if ($is_active == 1) {
            $sql = "UPDATE add_post SET is_active = 0 WHERE id = $id";
        } else {
            $sql = "UPDATE add_post SET is_active = 1 WHERE id = $id";
        }
        
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
       ?>         
    <meta http-equiv="refresh" content="1;url=http://localhost/learn%20php/Project/Website/addDisplay.php">
        <?php
        } else {
            echo "Error";
        }
    } else {
        echo "Failed to retrieve is_active value.";
    }
}

$conn->close();
    
    

?>
