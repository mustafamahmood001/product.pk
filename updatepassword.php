<?php
include 'temp1.php';
$role=$_SESSION['role'];
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
            width: 40%;
            /* Adjust the width as needed */
            height: 55%;
            /* Increase the height as desired */
            margin-left: -32%;
            margin-top: -9%;

            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .login-heading {
            text-align: center;
            font-size: 40px;
            margin-bottom: 40%;
            color: black;
            font-weight: bold;
            margin-left: 35%;
        }

        .form-label {
            margin-right: 60%;
            color: black;
            font-weight: 100;
            font-weight: bold;
            /* Adjust the margin to your preference */
        }

        .form-check-input {
            margin-right: 40px;
            /* Margin between radio buttons */
        }

        .formchecklabel {
            color: black;
            font-weight: bold
        }

        .inputs {
            margin-left: 35%;
            width: 70%;
            height: 50%;
        }

        #btn {
            margin-left: 2%;
            width: 45%;
            font-weight: bold;
            margin-top: 4%;
        }

        .error_message {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<?php
$oldPasswordErr = $newPasswordErr = $confirmPasswordErr = "";

include 'productdatabase.php';
$user_id = $_SESSION['id'];


$query = "SELECT password FROM signup WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$row = $result->fetch_assoc();
$getPassword = $row['password'];


if (isset($_POST['updatePassword'])) {
    $oldPassword = $_POST["oldPassword"];
    $newPassword = $_POST["newPassword"];
    $confirmPassword = $_POST["confirmPassword"];

    // oldpassword validation start
    if (empty($oldPassword)) {
        $oldPasswordErr = "Please enter a Old Password";
    } else {
        if ($oldPassword !== $getPassword) {
            $oldPasswordErr = "Please write correct password";
        }
    }
    // oldpassword validation end

    // newpassword validation start
    if (empty($newPassword)) {
        $newPasswordErr = "Please enter a new password";
    } else {
        if ($newPassword == $oldPassword) {
            $newPasswordErr = "New password must be different from the old password";
        }
        if (strlen($newPassword) < 8) {
            $newPasswordErr = "Password must be at least 8 characters long";
        }
        if (!preg_match("/[A-Z]/", $newPassword)) {
            $newPasswordErr = "Password must contain at least one uppercase letter";
        }
        if (!preg_match("/[a-z]/", $newPassword)) {
            $newPasswordErr = "Password must contain at least one lowercase letter";
        }
        if (!preg_match("/[0-9]/", $newPassword)) {
            $newPasswordErr = "Password must contain at least one digit";
        }
        if (!preg_match("/[^A-Za-z0-9]/", $newPassword)) {
            $newPasswordErr = "Password must contain at least one special character";
        }
    }
    // newassword validation end   

    // confirmpassword validation start
    if (empty($confirmPassword)) {
        $confirmPasswordErr = "Please enter confirm password";
    } else {
        if ($confirmPassword != $newPassword) {
            $confirmPasswordErr = "Passwords don't match";
        }
    }
    // confirmpassword validation end

// Query for update
if (empty($oldPasswordErr) && empty($newPasswordErr) && empty($confirmPasswordErr)) {

    $query = "UPDATE signup SET password='$newPassword' WHERE id=$user_id";
    $result = mysqli_query($conn, $query);

    if ($result) {

        $_SESSION['flash_message']="Password update successfully";
     ?>   
        <meta http-equiv="refresh" content="1;url=http://localhost/learn%20php/Project/Website/dashboard.php">
    <?php
    } else {
        echo "Error updating password";
    }


}
}
?>



<body>
    
    <div class='update d-flex align-items-center'>
    <div class="login-heading">Update Password</div>    
    <div class="login-form">
            <form method="post" enctype="multipart/form-data">
                <div class="inputs">
                    <div class="mb-1">
                        <label for="oldPassword" class="form-label">Old Password</label>
                        <input type="password" class="form-control form-control-sm" id="oldPassword" name="oldPassword" aria-describedby="oldPassword">
                        <div id="oldPassword-error" class="error_message">
                            <?php echo $oldPasswordErr; ?>
                        </div>
                    </div>
                    <div class="mb-1">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" class="form-control form-control-sm" id="newPassword" name="newPassword" aria-describedby="newPassword">
                        <div id="newPassword-error" class="error_message">
                            <?php echo $newPasswordErr; ?>
                        </div>
                    </div>
                    <div class="mb-1">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control form-control-sm" id="confirmPassword" name="confirmPassword">
                        <div id="confirmPassword-error" class="error_message">
                            <?php echo $confirmPasswordErr; ?>
                        </div>
                    </div>
                    <button type="submit" name="updatePassword" class="btn btn-success" id="btn">Update Password
                    </button>
            </form>

        </div>
    </div>


    <?php
    include 'temp2.php';
    ?>