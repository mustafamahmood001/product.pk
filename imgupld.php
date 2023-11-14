<?php
include 'temp1.php';

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
            width: 35%;
            /* Adjust the width as needed */
            height: 40%;
            /* Increase the height as desired */
            margin-left: -32%;
            margin-top: -11%;

            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .login-heading {
            text-align: center;
            font-size: 40px;
            margin-bottom: 40%;
            color: black;
            font-weight: bold;
            margin-left: 32%;
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
$uploadErr = "";
include 'productdatabase.php';

$user_id = $_SESSION['id'];

// ... (Code to check file size and type)

if (isset($_POST["submit"])) {
    $imageFolder = "imgUpload/";
    $targetFile = $imageFolder . basename($_FILES["imageUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if ($_FILES["imageUpload"]["size"] > 500000) {
        $uploadErr = "Sorry, your file is too large.";
    } elseif (!in_array($imageFileType, array("jpg", "png", "jpeg", "gif"))) {
        $uploadErr = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    } elseif (empty(basename($_FILES["imageUpload"]["name"]))) {
        $uploadErr = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }

    if (empty($uploadErr)) {
        if (move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $targetFile)) {
            $query = "UPDATE signup SET image='" . basename($_FILES["imageUpload"]["name"]) . "' WHERE id=$user_id";
            $result = mysqli_query($conn, $query);
            if ($result) {
                $_SESSION['flash_message']="Profile picture updated successfully";
                ?>
        <meta http-equiv="refresh" content="1;url=http://localhost/learn%20php/Project/Website/dashboard.php">

<?php
            } else {
                // Query execution failed
                $uploadErr = "Database error: " . mysqli_error($conn);
            }
        } else {
            $uploadErr = "Sorry, there was an error uploading your file.";
        }
    }
}
?>





<body>
    
    <div class='update d-flex align-items-center'>
    <div class="login-heading">Upload Profile Picture </div>    
    <div class="login-form">
            <form method="post" enctype="multipart/form-data">
            <div id="image" style="margin-left: 36%; margin-top:6%"> 
            <label for="uploadImage" class="form-label">Upload Image</label>
            <input type="file" name="imageUpload">
            <div id="uploadPic-error" class="error_message">
                            <?php echo $uploadErr; ?>
            </div>               
           </div>
           <div id="upload" style="margin-top: 10%; margin-left:38%;">
    <button type="submit" name="submit" class="btn btn-success">Upload</button>
        </div> 
            </form>

        </div>
    


    <?php
    include 'temp2.php';
    ?>