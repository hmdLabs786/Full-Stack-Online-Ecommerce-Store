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
    <!-- Meta and Title -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom Fonts and CSS -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

<!-- Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php include("aside.php"); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="h3 mb-0 text-gray-800">
                    <i class="fas fa-plus-circle mr-2 text-primary"></i>Add Product
                </h2>
                <p class="text-muted mt-2">Add new products to your inventory with detailed specifications</p>
            </div>
        </div>

        <!-- Product Add Form -->
        <div class="container">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-box mr-2"></i>Product Information
                    </h6>
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype='multipart/form-data'>

                        <!-- Product Name -->
                        <div class="form-group">
                            <label for="prodName">
                                <i class="fas fa-tag mr-2 text-primary"></i>Product Name
                            </label>
                            <input type="text" name="name" id="prodName" class="form-control" placeholder="Enter product name" required>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label for="prodDesc">
                                <i class="fas fa-align-left mr-2 text-primary"></i>Description
                            </label>
                            <textarea name="description" id="prodDesc" class="form-control" rows="3" placeholder="Enter product description" required></textarea>
                        </div>

                        <!-- Price -->
                        <div class="form-group">
                            <label for="prodPrice">
                                <i class="fas fa-dollar-sign mr-2 text-primary"></i>Price
                            </label>
                            <input type="text" name="price" id="prodPrice" class="form-control" placeholder="Enter product price" required>
                        </div>

                        <!-- Quantity -->
                        <div class="form-group">
                            <label for="prodQty">
                                <i class="fas fa-cubes mr-2 text-primary"></i>Quantity
                            </label>
                            <input type="text" name="qty" id="prodQty" class="form-control" placeholder="Enter available quantity" required>
                        </div>

                        <!-- Color -->
                        <div class="form-group">
                            <label for="prodColors">
                                <i class="fas fa-palette mr-2 text-primary"></i>Colors (comma-separated)
                            </label>
                            <input type="text" name="colors" id="prodColors" class="form-control" placeholder="Red, Blue, Green">
                        </div>

                        <!-- Shirt Type -->
                        <div class="form-group">
                            <label for="prodType">
                                <i class="fas fa-tshirt mr-2 text-primary"></i>Shirt Type
                            </label>
                            <input type="text" name="shirt_type" id="prodType" class="form-control" placeholder="e.g., Oversized Tee, Structured Polo">
                        </div>

                        <!-- Size -->
                        <div class="form-group">
                            <label for="prodSizes">
                                <i class="fas fa-ruler mr-2 text-primary"></i>Sizes (comma-separated)
                            </label>
                            <input type="text" name="sizes" id="prodSizes" class="form-control" placeholder="S, M, L, XL">
                        </div>

                        <!-- Category -->
                        <div class="form-group">
                            <label for="prodCat">
                                <i class="fas fa-folder mr-2 text-primary"></i>Category
                            </label>
                            <select name="cat" id="prodCat" class="form-control">
                                <option value="">Select Category</option>
                                <?php 
                                $q = mysqli_query($con, "SELECT * FROM categories");
                                while($cat = mysqli_fetch_array($q)){
                                    echo "<option value='{$cat[0]}'>{$cat[1]}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Tax Percentage -->
                        <div class="form-group">
                            <label for="prodTax">
                                <i class="fas fa-percentage mr-2 text-primary"></i>Tax Percentage (%)
                            </label>
                            <input type="number" name="tax_percent" id="prodTax" class="form-control" step="0.01" placeholder="e.g., 5 or 12.5">
                        </div>

                        <!-- Show Tax -->
                        <div class="form-group">
                            <label for="prodShowTax">
                                <i class="fas fa-eye mr-2 text-primary"></i>Show Tax Separately?
                            </label>
                            <select name="show_tax" id="prodShowTax" class="form-control">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>

                        <!-- Product Images -->
                        <div class="form-group">
                            <label>
                                <i class="fas fa-images mr-2 text-primary"></i>Product Images (color-wise)
                            </label>
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle mr-2"></i>
                                <strong>Note:</strong> For each color variant, upload two images — one front view and one back view <strong>(for hover effect)</strong>. Set the image that should appear on hover as <strong>Back</strong> in the dropdown.
                            </div>
                            <div id="img-group">
                                <div class="input-group mb-2">
                                    <input type="file" name="img[]" class="form-control" required>
                                    <input type="text" name="img_color[]" class="form-control" placeholder="Color name: Use exact names given above.">
                                    <select name="img_type[]" class="form-control" required>
                                        <option value="front">Front</option>
                                        <option value="back">Back</option>
                                    </select>
                                </div>
                            </div>
                            <button type="button" id="addMoreBtn" class="btn btn-sm btn-secondary">
                                <i class="fas fa-plus mr-1"></i>Add More
                            </button>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <button type="submit" name="btn_pro" class="btn btn-primary btn-lg">
                                <i class="fas fa-save mr-2"></i>Add Product
                            </button>
                            <a href="viewpro.php" class="btn btn-secondary btn-lg ml-2">
                                <i class="fas fa-eye mr-2"></i>View Products
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <?php
            if (isset($_POST['btn_pro'])) {
                $pname = $_POST['name'];
                $desc = $_POST['description'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $color = $_POST['colors'];
                $shirt_type = $_POST['shirt_type'];
                $size = $_POST['sizes'];
                $cat = $_POST['cat'];
                $tax_percent = $_POST['tax_percent'] ?? 0;
                $show_tax = $_POST['show_tax'] ?? 0;

                // Find the first front image to use as main product image
                $mainImage = 'default.png';

                // Pre-check for first front image
                if (isset($_FILES['img']['tmp_name'])) {
                    foreach ($_FILES['img']['tmp_name'] as $key => $tmp_name) {
                        if (!empty($tmp_name) && $_POST['img_type'][$key] === 'front') {
                            $file_name = $_FILES['img']['name'][$key];
                            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
                            if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'webp'])) {
                                $mainImage = time() . '_main_' . rand(1000, 9999) . '.' . $ext;
                                move_uploaded_file($tmp_name, "img/" . $mainImage);
                                break; // Use first front image as main
                            }
                        }
                    }
                }

                // ✅ INSERT PRODUCT FIRST with actual main image
                $q = mysqli_query($con, "INSERT INTO `products`(`name`, `description`, `price`, `qty`, `colors`, `shirt_type`, `sizes`, `cat_id`, `image`, `tax_percent`, `show_tax`) 
                VALUES ('$pname','$desc','$price','$qty','$color','$shirt_type','$size','$cat','$mainImage','$tax_percent','$show_tax')");

                if ($q) {
                    $product_id = mysqli_insert_id($con);
                    $main_image_used = false;

                    // Process all images
                    foreach ($_FILES['img']['tmp_name'] as $key => $tmp_name) {
                        if (!empty($tmp_name)) {
                            $file_name = $_FILES['img']['name'][$key];
                            $img_color = trim($_POST['img_color'][$key]);
                            $img_type = $_POST['img_type'][$key]; // front/back

                            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
                            if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'webp'])) {
                                
                                // If this is the first front image and we used it as main, reuse it
                                if ($img_type === 'front' && !$main_image_used && $mainImage !== 'default.png') {
                                    $new_name = $mainImage; // Use the already uploaded main image
                                    $main_image_used = true;
                                } else {
                                    // Upload new image
                                    $new_name = time() . '_' . rand(1000, 9999) . '.' . $ext;
                                    move_uploaded_file($tmp_name, "img/" . $new_name);
                                }

                                // ✅ Insert into product_images table (color can be empty)
                                mysqli_query($con, "INSERT INTO `product_images`(`product_id`, `color`, `image`, `type`) 
                                VALUES ('$product_id', '$img_color', '$new_name', '$img_type')");
                            }
                        }
                    }

                    echo "<script>
                            alert('Product added successfully with all images!');
                            window.location.href = 'addpro.php';
                        </script>";
                } else {
                    echo "<script>alert('Product insert failed');</script>";
                }
            }
            ?>

<script>
// 1. Add input group on button click
document.getElementById('addMoreBtn').addEventListener('click', function () {
    const imgGroup = document.getElementById('img-group');

    const inputGroup = document.createElement('div');
    inputGroup.className = 'input-group mb-2';

    inputGroup.innerHTML = `
        <div class="input-group-prepend">
            <button class="btn btn-danger remove-btn" type="button">❌</button>
        </div>
        <input type="file" name="img[]" class="form-control" required>
        <input type="text" name="img_color[]" class="form-control" placeholder="Color name (can be empty for back)">
        <select name="img_type[]" class="form-control" required>
            <option value="front">Front</option>
            <option value="back">Back</option>
        </select>
    `;

    imgGroup.appendChild(inputGroup);
});

// 2. Remove button functionality using event delegation
document.getElementById('img-group').addEventListener('click', function(e) {
    if (e.target && e.target.classList.contains('remove-btn')) {
        const group = e.target.closest('.input-group');
        if (group) group.remove();
    }
});
</script>

</script>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
</body>
</html>
