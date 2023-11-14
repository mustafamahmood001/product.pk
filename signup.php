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
        body {
            overflow: hidden;
        }

        #banner {
            width: 100%;
            height: auto;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                url(./th\ \(1\).jpg);
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
            width: 150%;
            /* Adjust the width as needed */
            height: 900px;
            /* Increase the height as desired */
            margin-left: auto;
            margin-right: 20%;
            /* Adjust the margin as needed */
            margin-bottom: -7%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .login-heading {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-check-label {
            margin-right: 40px;
            /* Adjust the margin to your preference */
        }

        .form-check-input {
            margin-right: 30px;
            /* Margin between radio buttons */
        }

        .error_message {
            color: red;
            font-size: 15px;
            font-weight: 3px;
        }

        #largeInputs {
            width: 60%;

        }
    </style>
</head>

<!-- php action for sign data save -->

<?php
// Define variables and set them to empty values
$fnameErr = $lnameErr = $emailErr = $renteremailErr = $passwordErr = $contactErr = $imageErr = $countryErr = $genderErr = $checkboxErr = "";

// Define variables and set them to empty values
$fname = $lname = $email = $renteremail = $contact = $image = $country = $gender = "";

include 'productdatabase.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $renteremail = $_POST["renteremail"];
    $password = $_POST["password"];
    $contact = $_POST["contact"];
    $gender = isset($_POST["male"]) ? "Male" : (isset($_POST["female"]) ? "Female" : "");
    $country = $_POST["country"];
    $image = $_FILES['image']['name'];
    $role = $_POST["role"];
    $target_dir = "imgUpload/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
// print_r($role);exit();

    // Validations
    if (empty($_POST["fname"])) {
        $fnameErr = "Please enter a valid name";
    } elseif (strlen($_POST["fname"]) < 3) {
        $fnameErr = "Name must be at least 3 characters long";
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $fname)) {
        $fnameErr = "Only letters and white space allowed";
    } else {
        $fname = ($_POST["fname"]);
    }
    // // For last name validation
    if (empty($_POST["lname"])) {
        $lnameErr = "Please enter a valid name";
    } elseif (strlen($_POST["lname"]) < 3) {
        $lnameErr = "Name must be at least 3 characters long";
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $lname)) {
        $lnameErr = "Only letters and white space allowed";
    } else {
        $lname = ($_POST["lname"]);
        // check if name only contains letters and whitespace
    }
    // for email validation
    if (empty($_POST["email"])) {
        $emailErr = "Please enter your email";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    } else {
        $email = $_POST["email"];
        // Check if the email is already in use
        $checkQuery = "SELECT id FROM signup WHERE email='$email'";
        $checkResult = mysqli_query($conn, $checkQuery);
        if (mysqli_num_rows($checkResult) > 0) {
            $emailErr = "Email already in use";
        }
    }
    // Validation for renteremail
    if (empty($_POST["renteremail"])) {
        $renteremailErr = "Please re-enter your email";
    } elseif ($renteremail !== $email) {
        $renteremailErr = "Email doesnt match";
    }
    // validation for password validation
    if (empty($_POST["password"])) {
        $passwordErr = "Please enter a password";
    } elseif (strlen($password) < 6) {
        $passwordErr = "Password must be at least 6 characters long";
    } elseif (!preg_match("/[A-Z]/", $password)) {
        $passwordErr = "Password must contain at least one uppercase letter";
    } elseif (!preg_match("/[a-z]/", $password)) {
        $passwordErr = "Password must contain at least one lowercase letter";
    } elseif (!preg_match("/[0-9]/", $password)) {
        $passwordErr = "Password must contain at least one digit";
    } elseif (!preg_match("/[^A-Za-z0-9]/", $password)) {
        $passwordErr = "Password must contain at least one special character";
    }
    if (empty($_POST["contact"])) {
        $contactErr = "Please enter your mobile no";
    } elseif (!preg_match("/[0-100]/", $contact)) {
        $contactErr = "Please enter valid number";
    }
    //    Validation for country
    if (empty($country)) {
        $countryErr = "Please Select your country";
    }

    // Validation for image
    if ($_FILES["image"]["size"] > 500000) {
        $imageErr = "Sorry, your file is too large.";
    } elseif (!in_array($imageFileType, array("jpg", "png", "jpeg", "gif"))) {
        $imageErr = "Only JPG,&JPEG files allowed.";
    } elseif (empty(basename($_FILES["image"]["name"])) || move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // File size, type, and image existence validation passed
        // The image has been successfully uploaded to the target directory
    } else {
        $imageErr = "There was an error uploading your image.";
    }

    // for gender validation
    if (isset($_POST['gender'])) {
        $gender = $_POST['gender'];
    } else {
        $genderErr = 'Please select a gender.';
    }
    //    Validation for $checkboxErr
    if (!isset($_POST['check1']) || !isset($_POST['check2'])) {
        $checkboxErr = "Please accept both policies";
    }





    if (empty($fnameErr) && empty($lnameErr) && empty($emailErr) && empty($renteremailErr) && empty($passwordErr) && empty($contactErr) && empty($imageErr) && empty($countryErr) && empty($genderErr) && empty($checkboxErr)) {

        $query = "INSERT INTO signup (fname, lname, email, renteremail, password, contact, gender, country, image, role) 
        VALUES ('$fname', '$lname', '$email', '$renteremail', '$password', '$contact', '$gender', '$country', '$image', '$role')";
        

        $result = mysqli_query($conn, $query);
        session_start();
        if ($result) {
            $_SESSION['flash_message'] = "Register successfully now you can login";
            header("Location: mainpage.php"); // Redirect to the main page
            exit(); // Make sure to exit after the header redirect
            // After successfully redirecting, display a JavaScript alert
        } else {
            echo "error";
        }
    }
}

?>



<body>
    <section id="banner" class="d-flex align-items-center">
        <div class="container" id="headings">
            <h1>Sign UP for Login</h1>
            <h2>You'll love working with our Website</h2>
            <h3>Enjoy With Best Experiences</h3>
        </div>
        <div class="login-form">
            <div class="login-heading">Sign UP</div>
            <form method="post" enctype="multipart/form-data">
                <div class="row mb-1">
                    <div class="col">
                        <label for="fname" class="form-label">First name</label>
                        <input type="text" class="form-control form-control-sm" id="fname" name="fname" aria-describedby="fname" value=<?php echo$fname;?>>
                        <div id="fname-error" class="error_message">
                            <?php echo $fnameErr; ?>
                        </div>
                    </div>
                    <div class="col">
                        <label for="lname" class="form-label">Last name</label>
                        <input type="text" class="form-control form-control-sm" id="lname" name="lname" aria-describedby="lname" value=<?php echo$lname;?>>
                        <div id="lname-error" class="error_message">
                            <?php echo $lnameErr; ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control form-control-sm" id="email" name="email" value=<?php echo$email;?>>
                        <div id="email-error" class="error_message">
                            <?php echo $emailErr; ?>
                        </div>
                    </div>
                    <div class="col">
                        <label for="renteremail" class="form-label">Re-enter email</label>
                        <input type="email" class="form-control form-control-sm" id="renteremail" name="renteremail" value=<?php echo$renteremail;?>>
                        <div id="renteremail-error" class="error_message">
                            <?php echo $renteremailErr; ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control form-control-sm" id="password" name="password" aria-describedby="password">
                        <div id="password-error" class="error_message">
                            <?php echo $passwordErr; ?>
                        </div>
                    </div>
                    <div class="col">
                        <label for="contact" class="form-label">ContactNo</label>
                        <input type="tel" class="form-control form-control-sm" id="contact" name="contact" aria-describedby="contact" value=<?php echo$contact;?>>
                        <div id="contact-error" class="error_message">
                            <?php echo $contactErr; ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col">
                        <label for="uploadImage" class="form-label">Upload Image</label>
                        <input type="file" name="image" value=<?php echo$image;?>>
                        <div id="image-error" class="error_message">
                            <?php echo $imageErr; ?>
                        </div>
                    </div>
                    <div class="col">
                        <div style="margin-left: -36%; margin-top:-13%;">
                            <br><label for="country" class="form-label">Select Country</label></br>
                            <select name="country" value=<?php echo$country;?>>
                                <option value="">Select a country</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="UnitedArabEmirated">UnitedArabEmirated</option>
                                <option value="UnitedKingdom">UnitedKingdom</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Srilanka">Srilanka</option>
                            </select>

                        </div>
                        <div id="country-error" class="error_message" style="margin-left:-37%">
                            <?php echo $countryErr; ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Please Select your gender</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="male" <?php echo$gender;?>>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php echo$gender;?>>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        <div id="gender-error" class="error_message">
                            <?php echo $genderErr; ?>
                        </div>
                        <div class="mb-3">
                        <label for="checkbox" class="form-label">Please Select both conditions</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="check1" id="check1">
                            <label class="form-check-label" for="check1">Accept all terms & conditions</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="check2" id="check2">
                            <label class="form-check-label" for="check2">Accept all policies</label>
                        </div>
                        <div id="checkbox-error" class="error_message">
                            <?php echo $checkboxErr; ?>
                        </div>
                    </div>
                    </div>
                    
                   <input type="hidden" value="user" name="role">
                    <button type="submit" class="btn btn-success" style="margin-top: -5%; width:30%; margin-left:20%">Sign Up</button>
            </form>
            <p style="text-align: center; margin-top: 10px;">Already a member? <a href="./mainpage.php">Login here</a></p>
        </div>

    </section>




</body>

</html>