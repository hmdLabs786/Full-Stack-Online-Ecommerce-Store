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
    <!-- Page Meta and Title -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Dashboard</title>

    <!-- Font & Template Styles -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <div id="wrapper">
        <!-- Sidebar / Aside Menu -->
        <?php include("aside.php"); ?>

        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row mb-4">
                <div class="col-12">
                    <h2 class="h3 mb-0 text-gray-800">
                        <i class="fas fa-plus-circle mr-2 text-primary"></i>Add Categories
                    </h2>
                    <p class="text-muted mt-2">Create new product categories to organize your inventory</p>
                </div>
            </div>

            <!-- Category Form -->
            <div class="container">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-tags mr-2"></i>Category Information
                        </h6>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype='multipart/form-data'>

                            <!-- Category Name -->
                            <div class="form-group">
                                <label for="catName">
                                    <i class="fas fa-tag mr-2 text-primary"></i>Category Name
                                </label>
                                <input type="text" name="name" id="catName" class="form-control" placeholder="Enter category name" required>
                            </div>

                            <!-- Category Description -->
                            <div class="form-group">
                                <label for="catDesc">
                                    <i class="fas fa-align-left mr-2 text-primary"></i>Category Description
                                </label>
                                <input type="text" name="des" id="catDesc" class="form-control" placeholder="Enter category description">
                            </div>

                            <!-- Category Image Upload -->
                            <div class="form-group">
                                <label for="catImg">
                                    <i class="fas fa-image mr-2 text-primary"></i>Category Image
                                </label>
                                <input type="file" name="img" id="catImg" class="form-control" accept="image/*" required>
                                <small class="form-text text-muted">Supported formats: PNG, JPG, JPEG, JFIF</small>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group">
                                <button type="submit" name="btn_cat" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save mr-2"></i>Add Category
                                </button>
                                <a href="viewcat.php" class="btn btn-secondary btn-lg ml-2">
                                    <i class="fas fa-eye mr-2"></i>View Categories
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <?php 
                // Handle Category Form Submission
                if (isset($_POST['btn_cat'])) {
                    $cname = $_POST['name'];
                    $cdes = $_POST['des'];
                    $catimg = $_FILES['img']['name'];
                    $cattmpname = $_FILES['img']['tmp_name'];
                    $detination = "img/" . $catimg;

                    // Get file extension
                    $extension = pathinfo($catimg, PATHINFO_EXTENSION);

                    // Validate image extension
                    if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'jfif') {
                        // Upload image to destination
                        if (move_uploaded_file($cattmpname, $detination)) {
                            // Insert category into database
                            $q = mysqli_query($con, "INSERT INTO `categories`(`cat_name`, `cat_des`, `image`) VALUES ('$cname','$cdes','$catimg')");
                            echo "<script>alert('Category added')</script>";
                        } else {
                            echo "<script>alert('Error uploading image')</script>";
                        }
                    } else {
                        echo "<script>alert('Extension does not match')</script>";
                    }
                }
                ?>
            </div>   
        </div>
    </div>

    <!-- Footer Section -->
    <?php include("footer.php") ?>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal Dialog -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>

                <!-- Modal Footer -->
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

    <!-- JavaScript Libraries -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Template Scripts -->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Chart Plugins (Not used here but included) -->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
