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
        margin-left: 78%;
        margin-top: -13%;
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
        margin-bottom: -40%;
    }
    #addCategory{
margin-top: -3%;
}

    */
</style>
<?php

include 'productdatabase.php';

$query="SELECT * FROM category";
$result=mysqli_query($conn,$query);
?>

<div class="content">
    <form method="post">
        <div id="control">
            <table id="example" class="table table-striped table-bordered" style="width:100%; ">
                <thead class="thead-dark" style="text-align:center">
                    <tr>
                        <th>Id</th>
                        <th>Category Name </th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody style="text-align:center">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['category'] . "</td>";
                            echo "<td>" . $row['description'] . "</td>";
                            echo "<td align='center' style='border:none'>
                                <a style='margin:3px' href='updateCategory.php?id=" . $row["id"] . "' class='btn btn-primary' data-placement='top' onclick='return confirmUpdate();' >
                                    <i class='fas fa-pencil-alt'></i>
                                </a>
                                <a style='margin:1px' href='deletecategory.php?id=" . $row["id"] . "' class='btn btn-danger' onclick='return confirmDelete()';>
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
                <div class="input-group mb-3" id="search">
                    <input type="text" class="form-control" name="search" placeholder="Search" aria-label="Search" aria-describedby="search-button">
                    <button class="btn btn-outline-success" type="submit" id="search-button">Search</button>
                    <a href="submitcategory.php"><button type="button" style="margin-left: -1350px; width:90px" class="btn btn-warning">+</button></a> 
                </div>
                

            </table>

    </form>
</div>
</div>
</div>



<?php
include 'temp2.php';
?>