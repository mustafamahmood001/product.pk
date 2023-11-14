<?php
session_start();

if (!$_SESSION['signIn']) {
    header('location:mainpage.php');
    die;
}



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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Website</title>
    <style>
        body {
            background: rgba(255, 255, 255, 0.8);
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            /* overflow: hidden; */
            /* Add this line */
        }


        #vertical {
            width: 15%;
            height: 100%;
            background-color: #282828;
            /* Set the background color to red */
            margin-left: 0%;
            /* margin-top: 0%; */

        }

        h4 {
            color: white;
            font-size: 180%;
            align-items: center;
        }

        #navi {
            border: 1px solid black;
        }

        .user_message {
            color: #3498db;
            margin-left: 33%;
            font-weight: 700;
        }

        h1 {
            margin-left: 40%;
            margin-bottom: 50%;
        }

        .content {

            width: 85%;
            height: 90%;
            /* border: 3px solid black; */
            margin-top: auto;
            margin-left: 15%;
            margin-top: -40%
                /* margin-bottom: 50%; */

        }

        .dark {
            background-color: #3498db;
        }

        .dropbtn {
            background-color: #3498DB;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropbtn:hover,
        .dropbtn:focus {
            background-color: #2980B9;
        }

        .dropdown {
            position: relative;
            display: inline-block;
            width: 400px;
            height: 10px;
            margin-top: -3%;
            margin-right: -264px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            /* display: block; */
        }

        .show {
            display: block;
        }

        #myDropdown {
            width: 360px;
            /* Set the desired width */
            height: 250px;
            /* Set the desired max height */
            overflow-y: auto;
            /* Enable vertical scrolling if the content exceeds the max height */
            margin-left: -50%;
            margin-top: 1px;
            border-radius: 3px;
            border: 1px solid black;
        }

        .picture {
            width: 100%;
            height: 70%;
            background-color: #3498DB;
        }

        .links {

            text-align: center;
            margin-top: -10%;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary" id="navi">
        <div class="container-fluid">
            <div class="spinner-grow text-primary m-0" role="status">
                <span class="visually-hidden">Loading...</span>
                <h1 style=" font-weight: 100px; font-size:35px;color: blue; margin: 0;">PRODUCT.pK</h1>
            </div>

            <div style="margin-left: 79%;">
                <?php
                include 'productdatabase.php';
                $user_id = $_SESSION['id'];

                $sql = "SELECT image FROM signup WHERE id= $user_id";
                $results = mysqli_query($conn, $sql);
                if ($results->num_rows > 0) {
                    while ($row = $results->fetch_assoc()) {
                        $profileImage = $row['image'];
                    }
                }
                echo "<img src='imgUpload/$profileImage' alt='profile' style='width:50px; height:50px; border-radius:50px; border: 2px solid grey; margin-left:120px; margin-top:5px'>";

                ?>
            </div>

            <div class="dropdown">
                <button onclick="myFunction()" class="dropbtn"> <?php echo ($_SESSION['fname'] . " " . $_SESSION['lname']); ?>
                </button>
                <div id="myDropdown" class="dropdown-content">
                    <div class="picture">
                        <?php
                        include 'productdatabase.php';
                        $user_id = $_SESSION['id'];

                        $sql = "SELECT image FROM signup WHERE id= $user_id";
                        $results = mysqli_query($conn, $sql);
                        if ($results->num_rows > 0) {
                            while ($row = $results->fetch_assoc()) {
                                $profileImage = $row['image'];
                            }
                        }

                        echo "<img src='imgUpload/$profileImage' alt='profile' style='width:100px; height:100px; border-radius:50px; border: 2px solid grey; margin-left:120px; margin-top:5px'>";


                        ?>
                        <div id="profilePic">
                            <button class="btn btn-secondary" style="width:53%; margin-top:20px; margin-left:23%;"><a href="imgupld.php">UploadProfilePicture</a></button>
                        </div>

                    </div>
                    <div class="links" style="margin:18px;" ;>
                        <button type="button" style="float:left" class="btn btn-primary"><a href="updatepassword.php">ChangePassword</a></button>
                        <button type="button" style="float:right" class="btn btn-danger"><a href="logout.php">LogOut</a></button>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <div class="verticalBar" style="width:100%; height: 95%; border: 1px solid black">
        <div class="container-fluid" id="vertical">
            <h4 style="font-weight:50%; color:blue">Menu</h4>
            <a href="dashboard.php">
                <button style="border-radius: 10px; width: 100%; padding: 10px 20px; margin-bottom: 15px; background-color: #3498db; color: #fff; border: none;">Home
                </button>
            </a>
            <?php
            if ($_SESSION['role'] == 'user') {
            ?>
            <a href="addPost.php">
                <button style="border-radius: 10px; width: 100%; padding: 10px 20px; margin-top:-5px; background-color: #3498db; color: #fff; border: none;">Add Post
                </button>
            </a>
            <?php
            }
            ?>
            <?php
            if ($_SESSION['role'] == 'user') {
            ?>
            <a href="addDisplay.php">
                <button style="border-radius: 10px; width: 100%; padding: 10px 20px; margin-top:8px; margin-bottom: 15px; background-color: #3498db; color: #fff; border: none;">My Adds
                </button>
            </a>
        <?php    
        }
            ?>
            <?php
            if ($_SESSION['role'] == 'admin') {
            ?>
                <a href="userdata.php">
                    <button style="border-radius: 10px; width: 100%; padding: 10px 20px; margin-top:-7px; margin-bottom: 15px; background-color: #3498db; color: #fff; border: none;">User Info
                    </button>
                </a>
            <?php
            }
            ?>
            <?php
            if ($_SESSION['role'] == 'admin') {
            ?>
                <a href="userStatus.php">
                    <button style="border-radius: 10px; width: 100%; padding: 10px 20px; margin-top:-7px; margin-bottom: 15px; background-color: #3498db; color: #fff; border: none;">Status
                    </button>
                </a>
            <?php
            }
            ?>
            <?php
            if ($_SESSION['role'] == 'admin') {
            ?>
            <a href="categoryDisplay.php">
                <button style="border-radius: 10px; width: 100%; padding: 10px 20px; margin-top:-6px; background-color: #3498db; color: #fff; border: none;">Category
                </button>
            </a>
            <?php
            }
            ?>
            <?php
            if ($_SESSION['role'] == 'admin') {
            ?>
            <a href="subcategoryDisplay.php">
                <button style="border-radius: 10px; width: 100%; padding: 10px 20px; margin-top:8px; margin-bottom: 15px; background-color: #3498db; color: #fff; border: none;">Sub Category
                </button>
            </a>
            <?php
            }
            ?>
            <?php
            if ($_SESSION['role'] == 'admin') {
            ?>
            <a href="brandDisplay.php">
                <button style="border-radius: 10px; width: 100%; padding: 10px 20px; margin-top:-5px; margin-bottom: 15px; background-color: #3498db; color: #fff; border: none;">Brand
                </button>
            </a>
        <?php    
        }
            ?>
        </div>
    </div>
    <script>
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>