<?php
include 'temp1.php';
$role = $_SESSION['role'];
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
            margin-top: -25%;

            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .login-heading {
            text-align: center;
            font-size: 40px;
            margin-top: -65%;
            color: black;
            font-weight: bold;
            margin-left: 41%;
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
            margin-left: 30%;
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
$categoryErr = $descriptionErr = "";

include 'productdatabase.php';

$user_id = $_GET['id'];

$sql = "SELECT * FROM category WHERE id=$user_id";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $category = $row["category"];
    $description = $row["description"];
}







if (isset($_POST['updateCategory'])) {
    $category = $_POST["category"];
    $description = $_POST["description"];

    // validation start
    if (empty($category)) {
        $categoryErr = "Please enter a Category";
    }
    if (empty($description)) {
        $descriptionErr = "Please enter description";
    }
    if (empty($categoryErr) && empty($descriptionErr)) {

        $query = "UPDATE category SET category='$category',description='$description' WHERE id=$user_id";
        $result = mysqli_query($conn, $query);

        if ($result) {

            $_SESSION['flash_message'] = "Category update successfully";
?>
            <meta http-equiv="refresh" content="1;url=http://localhost/learn%20php/Project/Website/category.php">
<?php
        } else {
            echo "Error updating password";
        }
    }
}
?>



<body>

    <div class='update d-flex align-items-center'>
        <div class="login-heading">Update Category</div>
        <div class="login-form">
            <form method="post" enctype="multipart/form-data">
                <div class="inputs">
                    <div class="mb-1">
                        <label for="category" class="form-label"></label>
                        <input type="text" class="form-control form-control-sm" id="category" name="category" aria-describedby="category" value="<?php echo $category; ?>">
                        <div id="category-error" class="error_message">
                            <?php echo $categoryErr; ?>
                        </div>
                    </div>
                    <div class="mb-1">
                        <label for="description" class="form-label">Description</label>
                        <input type="textarea" class="form-control form-control-sm" id="description" name="description" aria-describedby="description" value="<?php echo $description; ?>">
                        <div id="description-error" class="error_message">
                            <?php echo $descriptionErr; ?>
                        </div>
                    </div>
                </div>
                <button type="submit" name="updateCategory" class="btn btn-success" id="btn">Update Category
                </button>
            </form>

        </div>
    </div>


    <?php
    include 'temp2.php';
    ?>