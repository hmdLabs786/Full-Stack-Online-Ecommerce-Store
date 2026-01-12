<?php 
// Start session and check admin login
session_start();
if(isset($_SESSION['admin_username'])==null){
    echo "<script>location.assign('login.php')</script>";
}

// Database connection
include("connection.php"); 

/* ---- Delete product if ?del=id is present ---- */
if (isset($_GET['del'])) {
    $delid = intval($_GET['del']);
    mysqli_query($con, "DELETE FROM products WHERE id = $delid") or die(mysqli_error($con));
    header("Location: viewpro.php");
    exit;
}

/* ---- Fetch all products ---- */
$q = mysqli_query($con, "SELECT * FROM products") or die(mysqli_error($con));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>All Products</title>

    <!-- SB‑Admin‑2 assets -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
<div id="wrapper">

    <!-- Sidebar -->
    <?php include 'aside.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h2 class="h3 mb-0 text-gray-800">
                            <i class="fas fa-box mr-2 text-primary"></i>Products
                        </h2>
                        <p class="text-muted mt-2">Manage your product inventory and specifications</p>
                    </div>
                </div>

                <!-- Add Product Button -->
                <div class="row mb-4">
                    <div class="col-12">
                        <a href="addpro.php" class="btn btn-primary">
                            <i class="fas fa-plus mr-2"></i>Add New Product
                        </a>
                    </div>
                </div>

                <!-- Products Table -->
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-list mr-2"></i>Product List
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-dark">
                                <tr>
                                    <th><i class="fas fa-tag mr-2"></i>Name</th>
                                    <th><i class="fas fa-align-left mr-2"></i>Description</th>
                                    <th><i class="fas fa-dollar-sign mr-2"></i>Price</th>
                                    <th><i class="fas fa-cubes mr-2"></i>Quantity</th>
                                    <th><i class="fas fa-palette mr-2"></i>Color</th>
                                    <th><i class="fas fa-tshirt mr-2"></i>Shirt Type</th>
                                    <th><i class="fas fa-ruler mr-2"></i>Size</th>
                                    <th><i class="fas fa-folder mr-2"></i>Category</th>
                                    <th><i class="fas fa-percentage mr-2"></i>Tax %</th>
                                    <th><i class="fas fa-eye mr-2"></i>Show Tax</th>
                                    <th><i class="fas fa-images mr-2"></i>Images</th>
                                    <th><i class="fas fa-cogs mr-2"></i>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php while ($pro = mysqli_fetch_assoc($q)) { ?>
                                   <tr>
        <td>
            <strong class="text-primary"><?= htmlspecialchars($pro['name']) ?></strong>
        </td>
        <td><?= htmlspecialchars($pro['description']) ?></td>
        <td>
            <span class="badge badge-success">₨<?= htmlspecialchars($pro['price']) ?></span>
        </td>
        <td>
            <span class="badge badge-info"><?= htmlspecialchars($pro['qty']) ?></span>
        </td>
        <td><?= htmlspecialchars($pro['colors']) ?></td>
        <td><?= htmlspecialchars($pro['shirt_type']) ?></td>
        <td><?= htmlspecialchars($pro['sizes']) ?></td>
        <td><?= htmlspecialchars($pro['cat_id']) ?></td>
        <td><?= htmlspecialchars($pro['tax_percent']) ?>%</td>
        <td>
            <?php if($pro['show_tax'] == 1): ?>
                <span class="badge badge-success">Yes</span>
            <?php else: ?>
                <span class="badge badge-secondary">No</span>
            <?php endif; ?>
        </td>
        <td>
            <?php 
            $pid = $pro['id'];
            $img_query = mysqli_query($con, "SELECT * FROM product_images WHERE product_id = $pid");
            $images_by_color = [];
while ($img = mysqli_fetch_assoc($img_query)) {
    $color = $img['color'];
    $type = $img['type']; // front/back
    if (!isset($images_by_color[$color])) {
        $images_by_color[$color] = ['front' => null, 'back' => null];
    }
    $images_by_color[$color][$type] = $img['image'];
}

// Now show each color with front/back labels
foreach ($images_by_color as $color => $types) {
    echo "<div style='margin-bottom:8px'>";
    echo "<strong style='text-transform:capitalize;'>$color</strong><br>";
    
    if ($types['front']) {
        echo "<img src='img/{$types['front']}' height='50' style='border:1px solid #ccc; margin-right:5px;' title='Front'>";
    }

    if ($types['back']) {
        echo "<img src='img/{$types['back']}' height='50' style='border:1px solid #ccc;' title='Back'>";
    }

    echo "</div>";
}

            ?>
        </td>
        <td>
            <div class="btn-group" role="group">
                <a href="proupdate.php?pupdate=<?= $pro['id'] ?>" class="btn btn-info btn-sm">
                    <i class="fas fa-edit mr-1"></i>Update
                </a>
                <a href="viewpro.php?del=<?= $pro['id'] ?>" class="btn btn-danger btn-sm" 
                   onclick="return confirm('Are you sure you want to delete this product?')">
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

            </div><!-- /.container-fluid -->
        </div><!-- End of Main Content -->

        <!-- Footer -->
        <?php include 'footer.php'; ?>
    </div><!-- End of Content Wrapper -->
</div><!-- End of Page Wrapper -->

<!-- Scroll to Top -->
<a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

<!-- SB‑Admin‑2 scripts -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
</body>
</html>
