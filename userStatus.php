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
    }

    #search {
        width: 22%;
        margin-left: 78%;
        margin-top: -13%;
    }

    .pagination-button {
        display: inline-block;
        padding: 5px 10px;
        margin: 3px;
        background-color: #007bff;
        color: #fff;
        border: 1px solid #007bff;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .pagination-button:hover {
        background-color: #0056b3;
    }

    #paging {
        margin-left: 50%;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .table-wrapper table {
        width: 200%;
        table-layout: fixed;
    }

    .table-wrapper table td {
        width: 50%;
    }

    .table-wrapper table th {
        width: 50%;
    }
</style>
<?php
if (isset($_SESSION["flash_message"])) {
    $message = $_SESSION["flash_message"];
    unset($_SESSION["flash_message"]);
    echo "<div class='alert alert-success'>$message</div>";
}
?>
<div class="content">
    <div class="container" style="margin-top: -2%;">
        <form method="post">
            <div id="control">
                <div class="table-wrapper">
                    <table id="example" class="table table-striped table-bordered" style="width:100%;">
                        <thead class="thead-dark" style="text-align:center">
                            <tr>
                                <th>Id</th>
                                <th>Status</th>
                                <th>View Post</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody style="text-align:center">
                            <?php
                            include 'productdatabase.php';

                            $results_per_page = 8;
                            $sql = "SELECT * FROM add_post";
                            $result = mysqli_query($conn, $sql);
                            $number_of_results = mysqli_num_rows($result);

                            $number_of_pages = ceil($number_of_results / $results_per_page);

                            if (!isset($_GET['page'])) {
                                $page = 1;
                            } else {
                                $page = $_GET['page'];
                            }

                            $this_page_first_result = ($page - 1) * $results_per_page;
                            $sql .= " LIMIT " . $this_page_first_result . ',' . $results_per_page;
                            $result = mysqli_query($conn, $sql);

                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['status'] . "</td>";
                                echo "<td align='center' style='border:none'>
    <a style='margin:3px' href='adminAddView.php?id=" . $row["id"] . "' class='btn btn-info' data-placement='top'>
        <i class='fas fa-eye'></i>
    </a>
</td>";
                                $status = $row['status'];
                                $id = $row['id'];

                                if ($status == "approved") {
                                    echo "<td align='center' style='border:none'>
                                        <a style='margin:1px' href='statusAction.php?id=$id&newStatus=pending' class='btn btn-warning' onclick='return confirmChange();'>
                                            <i class='bi bi-backspace-reverse'></i> Pending
                                        </a>
                                        <a style='margin:1px' href='statusAction.php?id=$id&newStatus=reject' class='btn btn-danger' onclick='return confirmChange();'>
                                            <i class='bi bi-backspace-reverse'></i> Reject
                                        </a>
                                    </td>";
                                } elseif ($status == "pending") {
                                    echo "<td align='center' style='border:none'>
                                        <a style='margin:1px' href='statusAction.php?id=$id&newStatus=approved' class='btn btn-success' onclick='return confirmChange();'>
                                            <i class='bi bi-check-lg'></i> Approve
                                        </a>
                                        <a style='margin:1px' href='statusAction.php?id=$id&newStatus=reject' class='btn btn-danger' onclick='return confirmChange();'>
                                            <i class='bi bi-backspace-reverse'></i> Reject
                                        </a>
                                    </td>";
                                } elseif ($status == "reject") {
                                    echo "<td align='center' style='border:none'>
                                        <a style='margin:1px' href='statusAction.php?id=$id&newStatus=approved' class 'btn btn-success' onclick='return confirmChange();'>
                                            <i class='bi bi-check-lg'></i> Approve
                                        </a>
                                        <a style='margin:1px' href='statusAction.php?id=$id&newStatus=pending' class='btn btn-warning' onclick='return confirmChange();'>
                                            <i class='bi bi-backspace-reverse'></i> Pending
                                        </a>
                                    </td>";
                                }
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div id="paging">
                    <?php
                    // Pagination buttons
                    for ($page = 1; $page <= $number_of_pages; $page++) {
                        echo "<a class='pagination-button' href='userStatus.php?page=" . $page . "'>" . $page . "</a>";
                    }
                    ?>
                </div>
            </div>
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