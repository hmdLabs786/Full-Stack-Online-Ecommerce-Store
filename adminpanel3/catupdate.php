<?php
// Start session and check admin login
session_start();
if(isset($_SESSION['admin_username'])==null){
    echo "<script>location.assign('login.php')</script>";
}

include("connection.php");

// Fetch category details for update form
if (isset($_GET['up'])) {
    $up = $_GET['up'];
    $query = mysqli_query($con, "SELECT * FROM `categories` WHERE id=$up");
    $col = mysqli_fetch_array($query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta & Bootstrap CDN -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Admin Template CSS -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php include("aside.php"); ?>

    <!-- Page Content -->
    <div class="container-fluid">
        <div class="container mt-5">
            <!-- Page Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <h2 class="h3 mb-0 text-gray-800 text-center">
                        <i class="fas fa-edit mr-2 text-primary"></i>Update Category
                    </h2>
                    <p class="text-muted text-center mt-2">Modify category information and image</p>
                </div>
            </div>

            <!-- Update Category Form -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-tags mr-2"></i>Category Information
                    </h6>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="catName">
                                <i class="fas fa-tag mr-2 text-primary"></i>Category Name
                            </label>
                            <input type="text" name="name" id="catName" value="<?php echo $col[1] ?>" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="catDesc">
                                <i class="fas fa-align-left mr-2 text-primary"></i>Description
                            </label>
                            <input type="text" name="description" id="catDesc" value="<?php echo $col[2] ?>" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="catImg">
                                <i class="fas fa-image mr-2 text-primary"></i>Image
                            </label>
                            <input type="file" name="image" id="catImg" class="form-control" accept="image/*" required>
                            <small class="form-text text-muted">Supported formats: PNG, JPG, JPEG, JFIF, WEBP</small>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="update" class="btn btn-success btn-lg">
                                <i class="fas fa-save mr-2"></i>Update Category
                            </button>
                            <a href="viewcat.php" class="btn btn-primary btn-lg ml-2">
                                <i class="fas fa-eye mr-2"></i>View Categories
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    // Update category logic
    if (isset($_POST['update'])) {
        $cname = $_POST['name'];
        $des = $_POST['description'];
        $up = $_GET['up'];

        $imageName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $destination = "img/" . $imageName;
        $extension = pathinfo($imageName, PATHINFO_EXTENSION);

        if (in_array($extension, ['png', 'jpg', 'jpeg', 'jfif', 'webp'])) {
            if (move_uploaded_file($imageTmpName, $destination)) {
                $query = "UPDATE `categories` SET `cat_name`='$cname', `cat_des`='$des', `image`='$imageName' WHERE `id`='$up'";
                $result = mysqli_query($con, $query);

                if ($result) {
                    echo "<script>alert('Category updated successfully.');</script>";
                } else {
                    echo "<script>alert('Error updating category: " . mysqli_error($con) . "');</script>";
                }
            } else {
                echo "<script>alert('Failed to upload image.');</script>";
            }
        } else {
            echo "<script>alert('Invalid file type. Only images are allowed.');</script>";
        }
    }
    ?>

    <?php
    // Delete logic (if triggered by GET param)
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $del = mysqli_query($con, "DELETE FROM `categories` WHERE id=$id");
        if ($del) {
            echo "<script>alert('Data deleted'); location.assign('fetching.php');</script>";
        }
    }
    ?>

    <!-- Footer -->
    <?php include("footer.php"); ?>
</div>

<!-- Scroll to Top Button -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i>Cancel
                </button>
                <a class="btn btn-primary" href="login.php">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Core Scripts -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>

<!-- Charts (if needed) -->
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>

</body>
</html>
