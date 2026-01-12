<?php 
// Start session and check admin login
session_start();
if(isset($_SESSION['admin_username'])==null){
    echo "<script>location.assign('login.php')</script>";
}

// Database connection
include("connection.php") 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags and title -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Dashboard</title>

    <!-- Font Awesome & Google Fonts -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- SB Admin 2 CSS -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper Start -->
    <div id="wrapper">

        <!-- Sidebar Include -->
        <?php include("aside.php"); ?>

        <!-- Main Content Start -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row mb-4">
                <div class="col-12">
                    <h2 class="h3 mb-0 text-gray-800">
                        <i class="fas fa-tags mr-2 text-primary"></i>Categories
                    </h2>
                    <p class="text-muted mt-2">Manage and organize your product categories</p>
                </div>
            </div>

            <!-- Add Category Button -->
            <div class="row mb-4">
                <div class="col-12">
                    <a href="addcat.php" class="btn btn-primary">
                        <i class="fas fa-plus mr-2"></i>Add New Category
                    </a>
                </div>
            </div>

            <!-- Category Table -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-list mr-2"></i>Category List
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th><i class="fas fa-tag mr-2"></i>Name</th>
                                    <th><i class="fas fa-align-left mr-2"></i>Description</th>
                                    <th><i class="fas fa-image mr-2"></i>Image</th>
                                    <th><i class="fas fa-cogs mr-2"></i>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // Fetch all categories from database
                $q = mysqli_query($con, "SELECT * FROM categories");
                while($cat = mysqli_fetch_array($q)){
                ?>
                    <tr>
                                    <td>
                                        <strong class="text-primary"><?php echo $cat[1]?></strong>
                                    </td>
                        <td><?php echo $cat[2]?></td>
                                    <td>
                                        <img src="img/<?php echo $cat[3]?>" alt="Category Image" height="80px" class="img-thumbnail">
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="catupdate.php?up=<?php echo $cat[0]?>" class="btn btn-info btn-sm">
                                                <i class="fas fa-edit mr-1"></i>Update
                                            </a>
                                            <a href="?did=<?php echo $cat[0]?>" class="btn btn-danger btn-sm" 
                                               onclick="return confirm('Are you sure you want to delete this category?')">
                                                <i class="fas fa-trash mr-1"></i>Delete
                                            </a>
                                        </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
                    </div>
                </div>
            </div>
        </div>

        <?php
        // Handle category deletion
        if (isset($_GET["did"])) {
            $delid = $_GET["did"];
            $delq = mysqli_query($con, "DELETE FROM `categories` WHERE id='$delid'");
            if ($delq) {
                echo "<script> 
                        alert('Delete successfully');
                        location.assign('viewcat.php');
                      </script>";
            }
        }
        ?>

        <!-- Footer Include -->
        <?php include("footer.php") ?>

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Select "Logout" below if you are ready to end your current session.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </button>
                    <a class="btn btn-primary" href="login.html">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Files -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Optional Chart Scripts -->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>
</html>
