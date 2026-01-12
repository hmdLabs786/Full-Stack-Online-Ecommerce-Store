<?php
// Start session and check admin login
session_start();
if(isset($_SESSION['admin_username'])==null){
    echo "<script>location.assign('login.php')</script>";
}

include("connection.php");

// Add new delivery area and charges
if (isset($_POST['add'])) {
    $area = $_POST['area_name'];
    $charges = $_POST['charges'];
    mysqli_query($con, "INSERT INTO delivery_settings (area_name, charges) VALUES ('$area', '$charges')");
}

// Update existing delivery charges
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $charges = $_POST['charges'];
    mysqli_query($con, "UPDATE delivery_settings SET charges = '$charges' WHERE id = '$id'");
}

// Delete a delivery area entry
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($con, "DELETE FROM delivery_settings WHERE id = '$id'");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Manage Delivery Charges</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Include CSS files for styling -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body id="page-top">

<div id="wrapper">
    <?php include("aside.php"); // Sidebar include ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <!-- Main Page Content -->
            <div class="container-fluid mt-4">
                <!-- Page Heading -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h1 class="h3 mb-0 text-gray-800">
                            <i class="fas fa-truck mr-2 text-primary"></i>Manage Delivery Charges
                        </h1>
                        <p class="text-muted mt-2">Configure delivery areas and shipping charges for your customers</p>
                    </div>
                </div>

                <!-- Add New Area Form -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-plus mr-2"></i>Add New Delivery Area
                        </h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" class="mb-4">
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <label for="areaName">
                                        <i class="fas fa-map-marker mr-2 text-primary"></i>Area Name
                                    </label>
                                    <input type="text" name="area_name" id="areaName" class="form-control" placeholder="Enter area name" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="areaCharges">
                                        <i class="fas fa-dollar-sign mr-2 text-primary"></i>Delivery Charges
                                    </label>
                                    <input type="number" name="charges" id="areaCharges" class="form-control" placeholder="Enter charges" required>
                                </div>
                                <div class="col-md-4">
                                    <label>&nbsp;</label>
                                    <button type="submit" name="add" class="btn btn-primary w-100">
                                        <i class="fas fa-plus mr-2"></i>Add Area
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Display Existing Areas -->
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-list mr-2"></i>Existing Delivery Areas
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th><i class="fas fa-hashtag mr-2"></i>ID</th>
                                        <th><i class="fas fa-map-marker mr-2"></i>Area</th>
                                        <th><i class="fas fa-dollar-sign mr-2"></i>Charges</th>
                                        <th><i class="fas fa-edit mr-2"></i>Update</th>
                                        <th><i class="fas fa-trash mr-2"></i>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                // Fetch and display all delivery area records
                                $res = mysqli_query($con, "SELECT * FROM delivery_settings");
                                while ($row = mysqli_fetch_assoc($res)) {
                                    echo "<tr>
                                        <form method='POST'>
                                            <td><span class='badge badge-secondary'>{$row['id']}</span></td>
                                            <td><strong class='text-primary'>{$row['area_name']}</strong></td>
                                            <td>
                                                <div class='input-group'>
                                                    <div class='input-group-prepend'>
                                                        <span class='input-group-text'>₨</span>
                                                    </div>
                                                    <input type='number' name='charges' value='{$row['charges']}' class='form-control' required>
                                                    <input type='hidden' name='id' value='{$row['id']}'>
                                                </div>
                                            </td>
                                            <td>
                                                <button name='update' class='btn btn-success btn-sm'>
                                                    <i class='fas fa-save mr-1'></i>Update
                                                </button>
                                            </td>
                                            <td>
                                                <a href='?delete={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this delivery area?')\">
                                                    <i class='fas fa-trash mr-1'></i>Delete
                                                </a>
                                            </td>
                                        </form>
                                    </tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php include("footer.php"); // Footer include ?>
    </div>
</div>

<!-- Include JS scripts -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
</body>
</html>
