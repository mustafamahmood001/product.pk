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
            width: 70%;
            /* Adjust the width as needed */
            height: 100%;
            /* Increase the height as desired */
            margin-left: 15%;
            /* margin-right: 20%; */
            /* Adjust the margin as needed */

            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .login-heading {
            text-align: center;
            font-size: 50px;
            margin-bottom: 20px;
            color: black;
            font-weight: bold;
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
            margin-left: 35%;
            width: 33%;
            font-weight: bold;
        }

        .error_message {
            color: red;
            font-size: 14px;
        }
    </style>
</head>


<?php
$fnameErr = $lnameErr = $emailErr = $passwordErr = $contactErr = $genderErr = "";


include 'productdatabase.php';

// select and value display query
$user_id = $_GET['id'];

$query = "SELECT * FROM signup WHERE id='$user_id'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fname = $row["fname"];
    $lname = $row["lname"];
    $email = $row["email"];
    $contact = $row["contact"];
    $country = $row["country"];
    $gender = $row["gender"];
}

// Update query
if (isset($_POST['updateProduct'])) {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];
    $country = $_POST["country"];
    $gender = $_POST['gender'];


    // Validations

    // fname validation start
    if (empty($fname)) {
        $fnameErr = "Please enter your name";
    } else {
        if (strlen($fname) < 3) {
            $fnameErr = "Name must be at least 3 characters long";
        }
        if (!preg_match("/^[a-zA-Z-' ]*$/", $fname)) {
            $fnameErr = "Only letters and white space allowed";
        }
    }
    // fname validation end

    // lname validation start
    if (empty($lname)) {
        $lnameErr = "Please enter your name";
    } else {
        if (strlen($lname) < 3) {
            $lnameErr = "Name must be at least 3 characters long";
        }
        if (!preg_match("/^[a-zA-Z-' ]*$/", $lname)) {
            $lnameErr = "Only letters and white space allowed";
        }
    }
    // lname validation end

    // email validation start
    if (empty($email)) {
        $emailErr = "Please enter your email";
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
    // email validation end

    // contact validation start
    if (empty($contact)) {
        $contactErr = "Please enter contact number";
    } else {
        if (!preg_match("/[0-100]/", $contact)) {
            $contactErr = "Please enter valid number";
        }
    }
    // contact validation end

    if (empty($fnameErr) && empty($lnameErr) && empty($emailErr) && empty($passwordErr) && empty($contactErr) && empty($genderErr)) {

        $query = "UPDATE signup SET fname='$fname', lname='$lname', email='$email', contact='$contact',  country=' $country', gender='$gender' WHERE id=$user_id";

        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['flash_message'] = "Updade Successfully";

?>
            <meta http-equiv="refresh" content="1;url=http://localhost/learn%20php/Project/Website/userdata.php">
<?php
        } else {
            echo "Error";
        }
    }
}









?>



<body>
    <div class='update d-flex align-items-center'>
        <div class="login-form">
            <div class="login-heading">UPDATE</div>
            <form method="post" enctype="multipart/form-data">
                <div class="inputs">
                    <div class="mb-1">
                        <label for="fname" class="form-label">First name</label>
                        <input type="text" class="form-control form-control-sm" id="fname" name="fname" aria-describedby="fname" value="<?php echo $fname; ?>">
                        <div id="fname-error" class="error_message">
                            <?php echo $fnameErr; ?>
                        </div>
                    </div>
                    <div class="mb-1">
                        <label for="lname" class="form-label">Last name</label>
                        <input type="text" class="form-control form-control-sm" id="lname" name="lname" aria-describedby="lname" value="<?php echo $lname; ?>">
                        <div id="lname-error" class="error_message">
                            <?php echo $lnameErr; ?>
                        </div>
                    </div>
                    <div class="mb-1">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control form-control-sm" id="email" name="email" value="<?php echo $email; ?>">
                        <div id="email-error" class="error_message">
                            <?php echo $emailErr; ?>
                        </div>
                    </div>
                    <div class="mb-1">
                        <label for="number" class="form-label">ContactNo</label>
                        <input type="phone" class="form-control form-control-sm" id="contact" name="contact" aria-describedby="contact" value="<?php echo $contact; ?>">
                        <div id="email-error" class="error_message">
                            <?php echo $contactErr; ?>
                        </div>
                    </div>
                    <div style="display: flex; flex-direction: row; align-items: center;">
                        <div style="flex: 1;">
                            <label for="country" class="form-label">Select Country</label>
                            <select name="country">
                                <option value=""><?php echo $country ?></option>
                                <option>Pakistan</option>
                                <option>United Arab Emirates</option>
                                <option>United Kingdom</option>
                                <option>Bangladesh</option>
                                <option>Sri Lanka</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="male" <?php if ($gender === 'male') echo 'checked'; ?>>
                        <label class="formchecklabel" for="male">Male</label></br>
                        <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php if ($gender === 'female') echo 'checked'; ?>>
                        <label class="formchecklabel" for="female">Female</label>
                        <div id="gender-error" class="error_message">
                            <?php echo $genderErr; ?>
                        </div>
                    </div>
                </div>
                <button type="submit" name="updateProduct" class="btn btn-success" id="btn">UPDATE
                </button>

            </form>

        </div>
    </div>









    <?php
    include 'temp2.php';
    ?>