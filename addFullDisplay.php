<?php
include 'productdatabase.php';

if (isset($_GET['id'])) {
    $adId = $_GET['id'];
    // Fetch ad details based on adId from your database (modify this query)
    $query = "SELECT title, description, price, image FROM ads WHERE id = $adId";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
        $image = $row['image'];

        echo '<div class="ad-details">';
        echo '<h2>' . $title . '</h2>';
        echo '<p>Price: $' . $price . '</p>';
        echo '<img src="' . $image . '" alt="' . $title . '" />';
        echo '<p>' . $description . '</p>';
        echo '</div>';
    } else {
        echo 'Ad not found.';
    }

    mysqli_close($conn);
} else {
    echo 'Invalid request.';
}
?>
