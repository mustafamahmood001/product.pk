<?php
include 'temp1.php';

?>


</div>

</div>

<div class="content">
    <div class="container" style="margin-top: 5%;">
    <!-- flash message    -->

    <?php
    
    if(isset($_SESSION["flash_message"])){

       $message=$_SESSION["flash_message"];
       unset($_SESSION["flash_message"]);
    echo"<div class='alert alert-success'>$message</div>";
       
    }
    
     ?>
<?php
include 'temp2.php';
?>