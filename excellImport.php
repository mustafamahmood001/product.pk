<?php
include 'productdatabase.php';

use SimpleExcel\SimpleExcel;

if (isset($_POST['import'])) {

    if (move_uploaded_file($_FILES['excel_file']['tmp_name'], $_FILES['excel_file']['name'])) {

        require_once('SimpleExcel/SimpleExcel.php');
        $excel = new SimpleExcel('csv');
        $excel->parser->loadFile($_FILES['excel_file']['name']);

        $row = $excel->parser->getField();
        $count = 1;
    

        while (count($row) > $count) {
            $fname = $row[$count][0];
            $lname = $row[$count][1];
            $email = $row[$count][2];
            $gender = $row[$count][3];
            $country = $row[$count][4];
            $query = "INSERT INTO signup(fname, lname, email, gender, country)
                      VALUES('$fname', '$lname', '$email', '$gender', '$country')";
            mysqli_query($conn, $query);
            header('Location:userdata.php');

            $count++;
        }
    }
}
