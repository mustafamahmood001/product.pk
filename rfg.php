<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

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
      body{
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                url(./top-line-management-login-background-1.jpg);
                /* overflow: hidden; */
      }
        #banner {
            width: 100%;
            height: auto;
           
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        #headings {
            margin-bottom: 15%;
            margin-left: 15%;
            margin-right: 10%;
        }

        #headings h1 {
            font-size: 48px;
            font-weight: 500;
            color: #fff;
            margin: 0 0 10px 0;
        }

        #headings h2 {
            color: #eee;
            margin-bottom: 40px;
            font-size: 40px
        }

        #headings h3 {
            margin-bottom: 40px;
            font-size: 30px
        }

        /* Style for the form inputs */
        .form-control-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        #login {
            margin-bottom: 60%;
        }

        /* New CSS to align the form to the right */
        .login-form {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            width: 45%;
            /* Adjust the width as needed */
            height: 350px;
            /* Increase the height as desired */
            margin-left: auto;
            margin-right: 20%;
            /* Adjust the margin as needed */
            margin-bottom: 10%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .login-heading {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .error_message {

            color: red;
            font-size: 15px;
            font-weight: 3px;

        }
    </style>
</head>
<?php

// Error Define
$usernameErr = $passwordErr = "";




include 'productdatabase.php';


if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $pass = ($_POST["password"]);




    if (empty($_POST["username"])) {
        $usernameErr = "Please enter a username";
    } else {
        $checkQuery = "SELECT * FROM signup WHERE email='$username'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) == 0) {
            $usernameErr = "Invalid  Username";
        } else {
            $username = ($_POST["username"]);
        }
    }
    if (empty($_POST["password"])) {
        $passwordErr = "Please enter a password";
    } else {
        $chckQuery = "Select * From signup WHERE password='$pass'";
        $chckResult = mysqli_query($conn, $chckQuery);

        if (mysqli_num_rows($chckResult) == 0) {
            $passwordErr = "Invalid  Password";
        } else {
        }
    }


    $query = "SELECT * FROM signup WHERE email='$username' AND password='$pass' ";
    $result = mysqli_query($conn, $query);



    $userdata = $result->fetch_assoc();
    $id = $userdata['id'];
    $firstname = $userdata['fname'];
    $lasttname = $userdata['lname'];



    $total = mysqli_num_rows($result);

    if ($total > 0) {

        $_SESSION['user_name'] = $username;
        $_SESSION['id'] = $id;
        $_SESSION['fname'] = $firstname;
        $_SESSION['lname'] =  $lasttname;
        $_SESSION['signIn'] = true;


?>

        <meta http-equiv="refresh" content="1;url=http://localhost/learn%20php/Project/Website/dashboard.php">
<?php
    } else {
    }
}


?>

<body>


    <!-- Main Banner Section -->
    <div class='alert alert-success' id='alert' id="">##########</div>

    <section id="banner" class="d-flex align-items-center">


      
        <div class="container" id="headings">
            <h1>Meet the Business Website</h1>
            <h2>We are a top online Business team.</h2>
            <h3>You'll love working with our website</h3>
        </div>
        <!-- Form Container -->
        <div class="login-form">
            <div class="login-heading">Login</div>
            <form action="" method="post">
                <div class="mb-2">
                    <label for="username" class="form-label">Username</label>
                    <input type="username" class="form-control form-control-sm" name="username" id="username" aria-describedby="user_name">

                    <div id="username-error" class="error_message">
                        <?php echo $usernameErr; ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control form-control-sm" name="password" id="password">

                    <div id="password-error" class="error_message">
                        <?php echo $passwordErr; ?>

                    </div>

                </div>
                <button type="submit" name="login" class="btn btn-primary">Login
                </button>
            </form>
            <p style="text-align: center; margin-top: 10px;">Don't have an account? <a href="./signup.php">Sign Up</a>
            </p>
        </div>
    </section>
</body>

</html>