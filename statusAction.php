<?php
include 'productdatabase.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    $sql = "SELECT status FROM add_post WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $status = strtolower($row['status']); // Convert to lowercase for case insensitivity
        
        if ($status == "pending") {
            $newStatus = "approved";
        } elseif ($status == "approved") {
            $newStatus = "pending";
        } elseif ($status == "reject") {
            // Delete the record if the status is "reject"
            $sql = "DELETE FROM add_post WHERE id = $id";
        } else {
            // Handle other cases (e.g., "another_status") here
            $newStatus = "pending";
        }
        
        if (isset($newStatus)) {
            $sql = "UPDATE add_post SET status = '$newStatus' WHERE id = $id";
        }
        
        if (isset($sql)) {
            $result = mysqli_query($conn, $sql);
            
            if ($result) {
                header("Location: http://localhost/learn%20php/Project/Website/userStatus.php");
                exit();
            } else {
                echo "Error";
            }
        }
    } else {
        echo "Failed to retrieve status value.";
    }
    
    $conn->close();
}
?>
