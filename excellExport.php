<?php
include 'productdatabase.php';

// Create or open a file for writing with Excel format
$filename = "myData.xls"; // You can change the filename here
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$filename");

// Output the Excel header
echo "ID\tFirst Name\tLast Name\tEmail\tPhone\tCountry\tGender\n";

// Fetch data from the database and write it to the Excel file
$sql = "SELECT id, fname, lname, email, contact, country, gender FROM signup";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo "{$row['id']}\t{$row['fname']}\t{$row['lname']}\t{$row['email']}\t{$row['contact']}\t{$row['country']}\t{$row['gender']}\n";
}
?>