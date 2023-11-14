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

        #search {
            margin-right: 40%;
            /* margin-right: %; */
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
            height: 100%;
            border: 3px solid green;
            margin-top: auto;
            margin-left: 15%;
            margin-top: -40%
                /* margin-bottom: 50%; */

        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary" id="navi">
        <div class="container-fluid">
            <div class="spinner-grow text-primary m-0" role="status">
                <span class="visually-hidden">Loading...</span>
                <h1 style=" font-weight: 100px; font-size:35px;color: blue; margin: 0;">PRODUCT.pK</h1>
            </div>
            <form class="d-flex" role="search" id="search">
                <!-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button> -->
            </form>
            <div id="user" class="user_message">
                <?php echo strtoupper($_SESSION['fname'] . " " . $_SESSION['lname']); ?>
            </div>
            <div class="btn-group">
                <a href="logout.php">
                    <button class="btn btn-info btn btn-outline-primary dropdown-toggle" type="submit" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:aliceblue; background-color:blue">
                        Log Out
                    </button>
                </a>
            </div>
        </div>

        </div>
    </nav>

    <div class="verticalBar" style="width:100%; height: 85%; border: 1px solid black">
        <div class="container-fluid" id="vertical">
            <h4 style="font-weight:50%; color:blue">MENU</h4>
            <a href="dashboard.php">
                <button style="border-radius: 10px; width: 100%; padding: 10px 20px; margin-bottom: 15px; background-color: #3498db; color: #fff; border: none;">HOME
                </button>
            </a>
            <a href="userdata.php">
                <button style="border-radius: 10px; width: 100%; padding: 10px 20px; margin-bottom: 15px; background-color: #3498db; color: #fff; border: none;">USER INFO
                </button>
            </a>
            <a href=".php">
                <button style="border-radius: 10px; width: 100%; padding: 10px 20px;  background-color: #3498db; color: #fff; border: none;">####
                </button>
            </a>
        </div>
        <div class="content">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark"> <!-- Dark header styling from Bootstrap -->
                        <tr>
                            <th>Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>City Id</th>
                            <!-- <th>City</th> -->
                            <th>Image</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>


                    </tbody>
                </table>
            

        </div>

    </div>



</body>


</html>