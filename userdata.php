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

<style>
    .container {
        margin-top: 8%;
        /* Adjust the value as needed */
    }

    /* #content{
    margin-top: -10%;
   } */
    #search {
        width: 22%;
        margin-left: 76%;
        margin-top: -43%;
    }

    .pagination-button {
        display: inline-block;
        padding: 5px 10px;
        margin: 3px;
        background-color: #007bff;
        /* Set your desired background color */
        color: #fff;
        /* Set your desired text color */
        border: 1px solid #007bff;
        /* Set your desired border color */
        border-radius: 5px;
        /* Rounded corners */
        text-decoration: none;
        /* Remove underlines for links */
        font-weight: bold;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .pagination-button:hover {
        background-color: #0056b3;
        /* Change the background color on hover */
    }

    #paging {
        margin-left: 50%;
    }

    .control {
        margin-top: -50%;
    }
    #imp{
        margin-left:18%; 
        margin-top:-2%;
    }

    */
</style>
<?php

include 'productdatabase.php';

$num_per_page = 6;

// Determine the current page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset
$offset = ($page - 1) * $num_per_page;

$sql = "SELECT id, fname, lname, gender, email, contact, country, image FROM signup";

// Search
if (isset($_POST["search"])) {
    $search = $_POST["search"];
    $sql .= " WHERE id LIKE '%$search%' OR fname LIKE '%$search%' OR lname LIKE '%$search%' OR email LIKE '%$search%' OR gender LIKE '%$search%'";
}

// Add sorting conditions if needed
if (isset($_POST["sortdId"])) {
    $sql .= " ORDER BY id DESC";
}
if (isset($_POST["sortaId"])) {
    $sql .= " ORDER BY id ASC";
}


// First name sorting
if (isset($_POST["sortdFname"])) {
    $sql .= " ORDER BY fname DESC";
}
if (isset($_POST["sortaFname"])) {
    $sql .= " ORDER BY fname ASC";
}

// Last name sorting
if (isset($_POST["sortdLname"])) {
    $sql .= " ORDER BY lname DESC"; // Change to "lname" for last name sorting
}
if (isset($_POST["sortaLname"])) {
    $sql .= " ORDER BY lname ASC"; // Change to "lname" for last name sorting
}

// email sorting
if (isset($_POST["sortdEmail"])) {
    $sql .= " ORDER BY email DESC"; // Change to "email" for email sorting
}
if (isset($_POST["sortaEmail"])) {
    $sql .= " ORDER BY email ASC"; // Change to "email" for email sorting
}

// contact sorting
if (isset($_POST["sortdCntct"])) {
    $sql .= " ORDER BY contact DESC"; // Change to "contact" for contact sorting
}
if (isset($_POST["sortaCntct"])) {
    $sql .= " ORDER BY contact ASC"; // Change to "contact" for contact sorting
}

$result = mysqli_query($conn, $sql);

// Calculate total number of rows
$total_query = "SELECT COUNT(*) as total FROM signup";
$total_result = mysqli_query($conn, $total_query);
$total_data = mysqli_fetch_assoc($total_result);
$total_rows = $total_data['total'];

// Add LIMIT clause to retrieve the records for the current page
$sql .= " LIMIT $offset, $num_per_page";

$result = mysqli_query($conn, $sql);
?>

<a href="excellExport.php"><button class="btn btn-outline-warning" style="margin-left:45%; margin-top:-79%" type="submit" id="search-button"><i class="bi bi-file-excel-fill"></i> Export to Excell</button></a>   
<div class="input-group mb-3" id="search">
<input type="text" class="form-control" name="search" placeholder="Search" aria-label="Search" aria-describedby="search-button">
    <button class="btn btn-outline-success" type="submit" id="search-button">Search</button>
</div>
<form method="POST" action="excellImport.php" enctype="multipart/form-data">
<div id="imp">
<input type="file" name="excel_file" accept=".csv" style="margin-left:1%;">
<button class="btn btn-outline-secondary"  type="submit" name="import" style="margin-left:-6%;" value="Import"  id="search-button"><i class="bi bi-file-excel-fill"></i> Import to Excell</button>
</div>
</form>
<div class="content">
    <div class="container" style="margin-top: 5%;">
        <!-- flash message    -->
        <?php
        if (isset($_SESSION["flash_message"])) {
            $message = $_SESSION["flash_message"];
            unset($_SESSION["flash_message"]);
            echo "<div class='alert alert-success'>$message</div>";
        }
        ?>
    </div>

    <form method="post">
        <div id="control">
            <table id="example" class="table table-striped table-bordered" style="width:95%; margin-left:3%; margin-top: 48% ">
                <thead class="thead-dark" style="text-align:center">
                    <tr>
                        <th>Id <button type="submit" name="sortdId"><i class="bi bi-sort-down-alt"></i></button>
                            <button type="submit" name="sortaId"><i class="bi bi-sort-up-alt"></i></button>
                        </th>
                        <th>First Name <button type="submit" name="sortdFname"><i class="bi bi-sort-down-alt"></i></button>
                            <button type="submit" name="sortaFname"><i class="bi bi-sort-up-alt"></i></button>
                        </th>
                        <th>Last Name <button type="submit" name="sortdLname"><i class="bi bi-sort-down-alt"></i></button>
                            <button type="submit" name="sortaLname"><i class="bi bi-sort-up-alt"></i></button>
                        </th>
                        <th>Email <button type="submit" name="sortdEmail"><i class="bi bi-sort-down-alt"></i></button>
                            <button type="submit" name="sortaEmail"><i class="bi bi-sort-up-alt"></i></button>
                        </th>
                        <th>Phone <button type="submit" name="sortdCntct"><i class="bi bi-sort-down-alt"></i></button>
                            <button type="submit" name="sortaCntct"><i class="bi bi-sort-up-alt"></i></button>
                        </th>
                        <th>Country<button type="submit" name="sortdCountry"><i class="bi bi-sort-down-alt"></i></button>
                            <button type="submit" name="sortaCountry"><i class="bi bi-sort-up-alt"></i></button>
                        </th>
                        <th>Gender</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody style="text-align:center">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['fname'] . "</td>";
                            echo "<td>" . $row['lname'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['contact'] . "</td>";
                            echo "<td>" . $row['country'] . "</td>";
                            echo "<td>" . $row['gender'] . "</td>";
                            echo "<td>
                            <img src='imgUpload/$row[image]' alt='profile' style='width:70px; height:70px;'>
                            </td>";
                            echo "<td align='center' style='border:none'>
                                <a style='margin:3px' href='update.php?id=" . $row["id"] . "' class='btn btn-primary' data-placement='top' onclick='return confirmUpdate();' >
                                    <i class='fas fa-pencil-alt'></i>
                                </a>
                                <a style='margin:1px' href='deleteuser.php?id=" . $row["id"] . "' class='btn btn-danger' onclick='return confirmDelete()';>
                                    <i class='fas fa-trash'></i>
                                </a>
                            </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No results found.</td></tr>";
                    }
                    ?>
                </tbody>


            </table>

    </form>
</div>
<div id="paging">
    <?php
    // Calculate total number of pages
    $total_pages = ceil($total_rows / $num_per_page);

    // Generate pagination links
    echo "<div class='pagination'>";
    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a href='userdata.php?page=" . $i . "' class='pagination-button'>" . $i . "</a>";
    }
    echo "</div>";
    ?>
</div>
</div>
</div>



<?php
include 'temp2.php';
?>
<script>
    function confirmDelete() {
        var result = confirm("Are you sure you want to Delete?");
        if (result) {
            // Redirect to the table page after 3 seconds
            setTimeout(function() {
                window.location.href = "datatable.php";
            }, 3000);

            // Display a success message immediately
            alert("Successfully deleted!");

            return true;
        } else {
            return false;
        }
    }
</script>