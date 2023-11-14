<!DOCTYPE html>
<html>
    <body>
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
                    </body>
                </html>
