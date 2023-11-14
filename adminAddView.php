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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Website</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            /* overflow: hidden; */

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
            height: 9%;
        }

        #LoginSell {
            margin-left: 90%;
            margin-top: -3%;
        }

        .custom-button {
            height: 45px;
            /* Adjust the height as needed */
        }

        #spinner {
            margin-left: 1%;
            margin-top: -21px;
        }

        #lower {
            background-color: #f7f8f8;
            border: 1px solid black;
            width: 100%;
            height: 14%;
            margin-top: 2%;
        }

        #lowerContent {
            background-color: #002f34;
            width: 100%;
            /* border: solid 2px #002f34; */
            margin-top: 2%;
            height: 7%;
        }

        #social {
            margin-left: 41%;
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
            height: 579px;
            background-color: #002f34;
            color: white;
        }

        #adddisplay {
            width: 85%;

            margin-left: 15%;
            height: 129%;
            /* border: 3px solid red; */
            margin-top: -36%;
        }

        #image {
            border: solid 1px black;
            height: 99%;
            width: 40%;
        }
        #addContent{
            border:1px black green;
            width: 59%;
            margin-left: 41%;
            margin-top: -44%;
            height: 99%;
        }
    </style>



</head>

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
            <div id="LoginSell">
                <a href="dashboard.php">
                    <!-- <button class="btn btn-outline-dark custom-button" id="login-button">Login</button> -->
                </a>
                <a href="dashboard.php">
                    <!-- <button class="btn btn-outline-warning custom-button" id="sell-button">+ Sell</button> -->
                </a>
            </div>
        </div>
        <div class="row" style="width: 100%; height:73%">
            <!-- For product display -->
            <div id="filterBar">

            </div>

            <div id="adddisplay" style="overflow: hidden;">
                <div id="image">
    <div class="card" style="width: 24rem;">
        <?php
        include 'productdatabase.php';
        $addId = $_GET['id'];

        $query = "SELECT add_post.*, category.category, sub_category.sub_category, brands.brand
                  FROM add_post
                  LEFT JOIN category ON add_post.category = category.id
                  LEFT JOIN sub_category ON add_post.sub_category = sub_category.id
                  LEFT JOIN brands ON add_post.brand = brands.id 
                  WHERE  add_post.id = $addId";
        $result = mysqli_query($conn, $query);
        
        while ($row = mysqli_fetch_assoc($result)) {
            $imageNames = explode(',', $row['image']);
            
            echo "<div id='imageCarousel' class='carousel slide' data-ride='carousel'>";
            echo "<div class='carousel-inner'>";
            
            $first = true;
            foreach ($imageNames as $index => $imageName) {
                $activeClass = $first ? ' active' : '';
                echo "<div class='carousel-item$activeClass'>";
                echo "<img class='d-block w-100' style='height:550px; margin-left:1%; margin-top:5%;' src='addImage/$imageName' alt='Image $index'>";
                echo "</div>";
                $first = false;
            }
            
            echo "</div>";
            echo "<a class='carousel-control-prev' href='#imageCarousel' role='button' data-slide='prev'>";
            echo "<span class='carousel-control-prev-icon' aria-hidden='true'></span>";
            echo "<span class='sr-only'>Previous</span>";
            echo "</a>";
            echo "<a class='carousel-control-next' href='#imageCarousel' role='button' data-slide='next'>";
            echo "<span class='carousel-control-next-icon' aria-hidden='true'></span>";
            echo "<span class='sr-only'>Next</span>";
            echo "</a>";
            echo "</div>";
        }
        ?>
    </div>
</div>

                <div id="addContent">
              <?php
              include'productdatabase.php';
              $addId=$_GET['id'];

  $query = "SELECT add_post.*, category.category, sub_category.sub_category, brands.brand
  FROM add_post
  LEFT JOIN category ON add_post.category = category.id
  LEFT JOIN sub_category ON add_post.sub_category = sub_category.id
  LEFT JOIN brands ON add_post.brand = brands.id 
  WHERE  add_post.id = $addId"; 
           $result = mysqli_query($conn, $query);
            while($row=mysqli_fetch_assoc($result)){
            
            echo "<p style='font-weight: 700; font-size:28px;margin-left: 40%; margin-top:1%;'>Product: <span style='font-weight: 500;'>" . $row['product_name'] . "</span></p>";
            echo "<p style='font-weight: 700; font-size:18px;margin-left: 1%; margin-top:1%;'>Category:</br> <span style='font-weight: 500;'>" . $row['category'] . "</span></p>";
            echo "<p style='font-weight: 700; font-size:18px;margin-left: 43%; margin-top:-9%;'>Sub Category:</br> <span style='font-weight: 500;'>" . $row['sub_category'] . "</span></p>";
            echo "<p style='font-weight: 700; font-size:18px;margin-left: 86%; margin-top:-9%;'>Brand:</br> <span style='font-weight: 500;'>" . $row['brand'] . "</span></p>";
            echo "<p style='font-weight: 700; font-size:18px;margin-left: 1%; margin-top:1%;'>Condition:</br> <span style='font-weight: 500;'>" . $row['condition'] . "</span></p>";
            echo "<p style='font-weight: 700; font-size:18px;margin-left: 43%; margin-top:-9%;'>Assembly:</br> <span style='font-weight: 500;'>" . $row['assembly'] . "</span></p>";
            echo "<p style='font-weight: 700; font-size:18px;margin-left: 86%; margin-top:-9%;'>Color:</br> <span style='font-weight: 500;'>" . $row['color'] . "</span></p>";
            echo "<p style='font-weight: 700; font-size:18px;margin-left: 1%; margin-top:1%;'>Price:</br> <span style='font-weight: 500;'>" . $row['price'] . "</span></p>";
            echo "<p style='font-weight: 700; font-size:18px;margin-left: 43%; margin-top:-9%;'>Quantity:</br> <span style='font-weight: 500;'>" . $row['quantity'] . "</span></p>";
            echo "<p style='font-weight: 700; font-size:18px;margin-left: 1%; margin-top:-2%;'>Product Description:</br></p>";
           echo "<div style=' margin-top:-1%; margin-left:2%; width: 90%; height:18%; border: 1px solid black; border-radius: 7px;' ><span style='font-weight: 500;'>".$row['description']."</span></div>";
           echo "<p style='font-weight: 700; font-size:18px;margin-left: 43%; margin-top:2%;'>Seller Information:</br></p>";      
            echo "<p style='font-weight: 700; font-size:18px;margin-left: 1%;'>Seller name: <span style='font-weight: 500;'>" . $row['seller_name'] . "</span></p>";
            echo "<p style='font-weight: 700; font-size:18px;margin-left: 1%; margin-top:-1%;'>Contact number: <span style='font-weight: 500;'>" . $row['mobile_number'] . "</span></p>";
            echo "<p style='font-weight: 700; font-size:18px;margin-left: 1%; margin-top:-1%;'>Address: <span style='font-weight: 500;'>" . $row['address'] . "</span></p>";    
        }
          ?>
                </div>
            </div>
        </div>
        <!-- end for product display   -->
    </div>
    <div id="lower">
        <p style="margin-left: 45%;">Follow Us</p>
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