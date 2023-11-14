<style>
    #search {
        width: 22%;
        margin-left: 78%;
    }
</style>
<?php
include 'temp1.php';
include 'productdatabase.php';

$num_per_page = 7;

// Determine the current page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset
$offset = ($page - 1) * $num_per_page;

// Retrieve data from the database with pagination
$query = "SELECT * FROM signup LIMIT $offset, $num_per_page";
$results = $conn->query($query);

$sql = "SELECT id, fname, lname, gender, email, contact FROM signup";

// Search
if (isset($_POST["search"])) {
    $search = $_POST["search"];
    $sql .= " WHERE id LIKE '%$search%' OR fname LIKE '%$search%' OR lname LIKE '%$search%' OR email LIKE '%$search%' OR gender LIKE '%$search%'";
}

// id sorting
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

// Calculate total number of rows in the original SQL query (without sorting or filtering)
$total_query = "SELECT COUNT(*) as total FROM signup";
$total_result = mysqli_query($conn, $total_query);
$total_data = mysqli_fetch_assoc($total_result);
$total_rows = $total_data['total'];
?>

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

        <form method="post">
            <div class="input-group mb-3" id="search">
                <input type="text" class="form-control" name="search" placeholder="Search" aria-label="Search" aria-describedby="search-button">
                <button class="btn btn-outline-success" type="submit" id="search-button">Search</button>
            </div>

            <table id="example" class="table table-striped table-bordered" style="width:100%">
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
                        <th>Gender</button>
                     </th>
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
                            echo "<td>" . $row['gender'] . "</td>";
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
        </form>
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
