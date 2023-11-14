<!DOCTYPE html>
<html lang="en">

<head>
    <title>PRODUCT.pK</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Website</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        #search {
            width: 70%;
            margin-left: 15%;
            margin-top: -2%;
            border: 1px solid black;
            border-radius: 7px;
        }

        #search input.form-control {
            height: 45px;
            /* Adjust the height as needed */
        }

        .head {
            /* margin-left: 8%; */
            background-color: #f7f8f8;
            ;
            border: 1px solid black;
            width: 100%;
            height: 15%;
        }

        #LoginSell {
            margin-left: 87%;
            margin-top: -4%;
        }

        .custom-button {
            height: 45px;
            /* Adjust the height as needed */
        }

        #spinner {
            margin-left: 1%;
        }

        #lower {
            background-color: #f7f8f8;
            border: 1px solid black;
            width: 100%;
            height: 12%;
            margin-top: -1%;
        }

        #lowerContent {
            background-color: #002f34;
            width: 100%;
            border: solid 2px #002f34;
            margin-top: 2%;
            height: 7%;
        }

        #social {
            margin-left: 41%;
            margin-top: -3%;
        }

        .ad-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            /* 3 columns, adjust as needed */
            gap: 35px;
        }

        .ad-card {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
            width: 80%;
            height: 220px;
        }

        .ad-card img {
            max-width: 80%;
        }

        .ad-card a {
            text-decoration: none;
            color: #333;
        }

        #filterBar {

            /* border: solid 3px green; */
            width: 14%;
            height: 100%;
            background-color: #002f34;
            color: white;
        }

        #adddisplay {
            width: 85%;

            margin-left: 15%;
            /* border: 3px solid red; */
            margin-top: -31%;
        }

        .ad-card {
            display: inline-block;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .ad-card:hover {
            background-color: #a8d0e6;
            /* Light blue background on hover */
            color: #000;
            /* Change the text color on hover */
        }

        .ad-link {
            text-decoration: none;
            /* Remove the underline */
            color: #333;
            /* Set the default text color */
        }
    </style>



</head>
<?php
$search = "";
?>

<body>

    <div class="main" style="width:100%; height:100%; ">
        <div class="head">
            <p style="font-size: 15px; font-weight: 1000; margin-left:2%;">Product.pk</p>
            <div id="spinner">
                <div class="spinner-grow text-primary m-0" role="status">
                    <span class="visually-hidden">Loading...</span>
                    <h1 style=" margin-left:20%;  font-weight: 100px; font-size:35px;color: blue; margin: 0;">PRODUCT.pK</h1>
                </div>
            </div>
            <form method="POST">
                <div class="input-group mb-3" id="search">
                    <input type="text" class="form-control" name="search" placeholder="Search" value="<?php echo $search ?>" aria-label="Search" aria-describedby="search-button">
                    <button class="btn btn-outline-success" type="submit" id="search-button"><i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
            <div id="LoginSell">
                <a href="dashboard.php">
                    <button class="btn btn-outline-dark custom-button" id="login-button">Login</button>
                </a>
                <a href="dashboard.php">
                    <button class="btn btn-outline-warning custom-button" id="sell-button">+ Sell</button>
                </a>
            </div>
        </div>
        <div class="row" style="width: 100%; height:73%">
            <!-- For product display -->
            <div id="filterBar">

            </div>
            <div id="adddisplay" style="overflow: hidden;">
                <?php
                $search = "";
                include 'productdatabase.php';

                $limitRecods = 8;
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $offset = ($page - 1) * $limitRecods;

                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])) {
                    $search = $_POST["search"];
                    $sql = "SELECT id, product_name, price, image FROM add_post WHERE status='approved' AND product_name LIKE '%$search%' LIMIT {$offset},{$limitRecods}";
                } else {
                    // If no search term is provided, display all data
                    $sql = "SELECT id, product_name, price, image FROM add_post WHERE status='approved' LIMIT {$offset},{$limitRecods}";
                }
                $result = mysqli_query($conn, $sql);
                if ($result === false) {
                    // Handle the query execution error
                    echo "Error: " . mysqli_error($conn);
                } else if (mysqli_num_rows($result) > 0) {
                    echo '<div class="ad-grid" id="girds">';
                    while ($row = mysqli_fetch_assoc($result)) {
                        $adId = $row['id'];
                        $product_name = $row['product_name'];
                        $price = $row['price'];
                        $images = explode(',', $row['image']); // Split the comma-separated image names

                        // Determine the main image (the first image in the list)
                        $mainImage = (!empty($images)) ? $images[0] : 'default.jpg';

                        // Output each ad in the grid with an anchor tag and hover effect
                        echo '<div class="ad-card">';
                        echo '<a href="viewAdd.php?id=' . $row['id'] . '" class="ad-link">';
                        echo '<img src="addImage/' . $mainImage . '" alt="' . $product_name . '" />';
                        echo '<h3>' . $product_name . '</h3>';
                        echo '<p>PKR: ' . $price . '</p>';
                        echo '</a>';
                        echo '</div>';
                    }
                    echo '</div>';
                }
                ?>
            </div>
            <!-- Pagination -->
            <div id="lower">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])) {
                    // No need for pagination in search results
                } else {
                    $sql1 = "SELECT * FROM add_post";
                    $result1 = mysqli_query($conn, $sql1);
                    if ($result1) {
                        $totalRecods = mysqli_num_rows($result1);
                        $totalPages = ceil($totalRecods / $limitRecods);
                        echo "<div class='text-center' style='margin-left: 80%; margin-top: 1%'>";
                        echo "<ul class='pagination admin-pagination'>";
                        for ($i = 1; $i <= $totalPages; $i++) {
                            echo "<li><a class='btn btn-success' style='margin: 5px; ' href='frontview.php?page={$i}'>{$i}</a></li>";
                        }
                        echo "</ul>";
                        echo "</div>";
                    }
                }
                ?>
            </div>
            <p style="margin-left: 45%; margin-top:-4%">Follow Us</p>
            <div id="social">
                <i class="fab fa-facebook-f fa-2x" style="color: #3b5998;"></i>
                <i class="fab fa-twitter fa-2x" style="color: #55acee;"></i>
                <i class="fab fa-google fa-2x" style="color: #dd4b39;"></i>
                <i class="fab fa-instagram fa-2x" style="color: #ac2bac;"></i>
                <i class="fab fa-whatsapp fa-2x" style="color: #25d366;"></i>
                <i class="fab fa-youtube fa-2x" style="color: #ed302f;"></i>
            </div>
        </div>
    </div>
</body>

</html>