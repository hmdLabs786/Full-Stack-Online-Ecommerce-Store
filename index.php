<?php
// Start the session and include database connection
session_start();
include('connection.php');

// Handle adding products to the cart
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_name'], $_POST['product_price'], $_POST['product_image'])) {
    $item = [
        'proname'     => $_POST['product_name'],
        'proprice'    => $_POST['product_price'],
        'proqty'      => 1,
        'proimg'      => $_POST['product_image'],
        'sizes'       => $_POST['product_sizes'],
        'colors'      => $_POST['product_colors'],
        'shirt_type'  => $_POST['product_shirt_type'],
        'description' => $_POST['description'],
    ];
    
    // Initialize cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    $found = false;
    // Check if the product is already in the cart and update quantity
    foreach ($_SESSION['cart'] as &$cartItem) {
        if ($cartItem['proname'] === $item['proname']) {
            $cartItem['proqty'] += 1;
            $found = true;
            break;
        }
    }
    
    // Add new product to cart if not found
    if (!$found) {
        $_SESSION['cart'][] = $item;
    }
    
    // Redirect to the index page
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="icon" type="image/png" href="images/icons/zufelogo-removebg-preview.png"/>
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="vendor/MagnificPopup/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/mobile-fixes.css">

    
    <style>
        .btn-addwish-b2 .icon-heart1 {
            filter: grayscale(100%);
            transition: filter 0.3s ease;
        }
        .btn-addwish-b2:hover .icon-heart1,
        .btn-addwish-b2.active-wishlist .icon-heart1 {
            filter: sepia(1) saturate(700%) hue-rotate(265deg) brightness(0.4);
        }
        .btn-addwish-b2 { cursor: pointer; }
        .color-circle {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid transparent;
            transition: 0.2s ease;
        }
        .block2-pic { position: relative; overflow: hidden; }
        .image-container {
            position: relative;
            width: 100%;
            height: auto;
        }
        .product-image {
            width: 100%;
            height: auto;
            display: block;
            transition: opacity 0.3s ease;
        }
        .back-img {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }
        .image-container:hover .main-img { opacity: 0; }
        .image-container:hover .back-img { opacity: 1; }
        .color-btn.active {
            border: 2px solid #333 !important;
            transform: scale(1.1);
        }
        .color-btn {
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .color-btn:hover {
            transform: scale(1.1);
            border-color: #333 !important;
        }
        .rating-stars {
            display: flex;
            gap: 5px;
            margin-top: 5px;
            cursor: pointer;
            font-size: 13px;
            color: #ccc;
        }
        .rating-stars .fa-star { color: #c2711aff; }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        
        .modal-dialog {
            background-color: white;
            margin: 5% auto;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 600px;
            position: relative;
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        
        .modal-title {
            margin: 0;
            font-size: 1.5rem;
        }
        
        .modal-close {
            background: none;
            border: none;
            font-size: 2rem;
            cursor: pointer;
            color: #666;
        }
        
        .modal-close:hover {
            color: #000;
        }
        
        .modal-body {
            padding: 20px 0;
        }
        
        /* Mobile fixes for slider - now handled by mobile-fixes.css */
        
        /* Mobile fixes - now handled by mobile-fixes.css */
    </style>
</head>
<body class="animsition">
    
    <?php include('header.php'); ?>
    
    <section class="section-slide">
        <div class="wrap-slick1">
            <div class="slick1">
                <div class="item-slick1 img-fluid" style="background-image: url(images/milsil2-Picsart-AiImageEnhancer.png);">
                    <div class="container h-full">
                        <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                            <div class="layer-slick1">
                                <span class="ltext-101 cl2 respon2">Men Collection 2025</span>
                            </div>
                            <div class="layer-slick1">
                                <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">NEW SEASON</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-slick1" style="background-image: url(images/gensil1-Picsart-AiImageEnhancer.png);">
                    <div class="container h-full">
                        <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                            <div class="layer-slick1"><span class="ltext-101 cl2 respon2">Men New-Season</span></div>
                            <div class="layer-slick1"><h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">New arrivals</h2></div>
                        </div>
                    </div>
                </div>
                <div class="item-slick1" style="background-image: url(images/boomsil1-Picsart-AiImageEnhancer.png);">
                    <div class="container h-full">
                        <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                            <div class="layer-slick1"><span class="ltext-101 cl2 respon2">Men Collection</span></div>
                            <div class="layer-slick1"><h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">THE Quiet Statement</h2></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <div class="sec-banner bg0 p-t-20 p-b-50">
        <div class="container">
            <div class="row">
                <?php
                // Fetch and display categories from the database
                $q = mysqli_query($con, "SELECT * FROM `categories`");
                while ($cat = mysqli_fetch_array($q)) {
                ?>
                <div id="cat" class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                    <div class="block1 wrap-pic-w">
                        <img src="adminpanel3/img/<?php echo $cat[3] ?>" alt="Category">
                        <a href="product.php?id=<?php echo $cat[0] ?>" class="block1-txt s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div class="block1-txt-child1 flex-col-l">
                                <span class="block1-name ltext-102 trans-04 p-b-8"><?php echo $cat[1] ?></span>
                                <span class="block1-info stext-102 trans-04"><?php echo $cat[2] ?></span>
                            </div>
                        </a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    
    <section class="bg0 p-t-23 p-b-140">
        <div class="container">
            <div class="p-b-10 text-center">
                <h3 class="ltext-103 cl5">Explore Our Products</h3>
            </div>
            <div class="row isotope-grid">
                <?php
                // Fetch and display products
                $q = mysqli_query($con, "SELECT * FROM `products`");
                while ($row = mysqli_fetch_array($q)) {
                    // Extract sizes and colors
                    $sizes = explode(',', $row['sizes']);
                    $colors = explode(',', $row['colors']);
                    $product_id = $row['id'];
                    
                    // Fetch all images for the product
                    $img_query = mysqli_query($con, "SELECT * FROM product_images WHERE product_id = $product_id ORDER BY id ASC");
                    $all_product_images = [];
                    $first_front_img = $row[9];
                    $first_back_img = $row[9];
                    
                    while ($img_row = mysqli_fetch_assoc($img_query)) {
                        $color_key = strtolower(trim($img_row['color']));
                        $type = strtolower($img_row['type']);
                        
                        if (!isset($all_product_images[$color_key])) {
                            $all_product_images[$color_key] = [];
                        }
                        $all_product_images[$color_key][$type] = $img_row['image'];
                    }
                    
                    // Set default back image if available
                    $default_back_img = '';
                    if (isset($all_product_images['']['back'])) {
                        $default_back_img = $all_product_images['']['back'];
                    }
                    
                    // Set initial front and back images based on first color
                    if (!empty($colors)) {
                        $first_color = strtolower(trim($colors[0]));
                        if (isset($all_product_images[$first_color]['front'])) {
                            $first_front_img = $all_product_images[$first_color]['front'];
                        } else {
                            foreach ($all_product_images as $color_imgs) {
                                if (isset($color_imgs['front'])) {
                                    $first_front_img = $color_imgs['front'];
                                    break;
                                }
                            }
                        }
                        if (!empty($default_back_img)) {
                            $first_back_img = $default_back_img;
                        } elseif (isset($all_product_images[$first_color]['back'])) {
                            $first_back_img = $all_product_images[$first_color]['back'];
                        } else {
                            if ($first_back_img == $row[9]) {
                                $first_back_img = $first_front_img;
                            }
                        }
                    }
                ?>
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                    <div class="block2" data-product-id="<?php echo $product_id; ?>">
                        <div class="block2-pic hov-img0">
                            <a href="product-detail.php?proid=<?php echo $row[0]; ?>">
                                <div class="image-container">
                                    <img src="adminpanel3/img/<?php echo $first_front_img; ?>" 
                                         alt="Front Image" 
                                         class="product-image main-img current-front">
                                    <img src="adminpanel3/img/<?php echo $first_back_img; ?>"
                                         alt="Back Image" 
                                         class="product-image back-img current-back">
                                </div>
                            </a>
                            <button class="block2-btn show-modal-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04" data-id="<?php echo $row[0]; ?>">
                                Quick View
                            </button>
                        </div>
                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l">
                                <span class="stext-105 cl3" style="font-weight: bold;"><?php echo $row[1]; ?></span>
                                <span class="stext-105 cl3 mt-2"><?php echo $row[2]; ?></span>
                                <span class="stext-105 cl3 mt-2" style="font-weight: bold;">Rs: <?php echo $row[3]; ?></span>
                                
                                <span class="stext-104 cl3 mt-2"><b>Sizes: 
                                    <?php foreach ($sizes as $size) {
                                        echo "<span style='margin-right:5px;'>$size</span>";
                                    } ?></b>
                                </span>
                                
                                <div style="margin-top: 5px;">
                                    <?php
                                    foreach ($colors as $index => $color):
                                        $color_trim = strtolower(trim($color));
                                        
                                        $front_img = isset($all_product_images[$color_trim]['front']) 
                                                    ? $all_product_images[$color_trim]['front'] 
                                                    : $first_front_img;
                                        
                                        $back_img = $front_img;
                                        if (!empty($default_back_img)) {
                                            $back_img = $default_back_img;
                                        } elseif (isset($all_product_images[$color_trim]['back'])) {
                                            $back_img = $all_product_images[$color_trim]['back'];
                                        }
                                    ?>
                                    <button class="color-btn color-circle <?php echo $index === 0 ? 'active' : ''; ?>"
                                        style="background: <?php echo $color ?>; border: 1px solid #ccc; width: 15px; height: 15px; margin: 2px; cursor:pointer;"
                                        title="<?php echo $color ?>"
                                        data-front-img="adminpanel3/img/<?php echo htmlspecialchars($front_img) ?>"
                                        data-back-img="adminpanel3/img/<?php echo htmlspecialchars($back_img) ?>"
                                        data-color="<?php echo htmlspecialchars($color) ?>">
                                    </button>
                                    <?php endforeach; ?>
                                </div>
                                
                                <div class="rating-stars" data-product-id="<?php echo $row['id']; ?>" style="margin-top: 10px;">
                                    <i class="fa fa-star-o" data-value="1"></i>
                                    <i class="fa fa-star-o" data-value="2"></i>
                                    <i class="fa fa-star-o" data-value="3"></i>
                                    <i class="fa fa-star-o" data-value="4"></i>
                                    <i class="fa fa-star-o" data-value="5"></i>
                                </div>
                                <input type="hidden" id="rating-value-<?php echo $row['id']; ?>" value="">
                            </div>
                            
                            <div class="block2-txt-child2 flex-r p-t-3">
                                <a href="#" class="btn-addwish-b2 js-addwish-b2" data-id="<?php echo $row[0]; ?>">
                                    <i class="fa fa-heart icon-heart1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    
    <div id="productModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-header">
                <h3 class="modal-title">Product Details</h3>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <div id="modal-body-content"></div>
            </div>
        </div>
    </div>
    
    <?php include("footer.php"); ?>
    
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>
    
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script>$(".js-select2").select2({minimumResultsForSearch: 20, dropdownParent: $('.dropDownSelect2')});</script>
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <script src="vendor/slick/slick.min.js"></script>
    <script src="js/slick-custom.js"></script>
    <script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
    <script src="vendor/isotope/isotope.pkgd.min.js"></script>
    <script src="vendor/sweetalert/sweetalert.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/mobile-enhancements.js"></script>
    
    
    
    <?php
    // Fetch wishlist products for the current user
    $wishlist_products = [];
    $user_id = $_SESSION['user_id'] ?? $_SESSION['guest_id'] ?? null;
    if ($user_id) {
        $res = mysqli_query($con, "SELECT product_id FROM wishlist WHERE user_id = '$user_id'");
        while ($row = mysqli_fetch_assoc($res)) {
            $wishlist_products[] = $row['product_id'];
        }
    }
    ?>
    
    <script>
        // Use PHP to pass wishlist data to JavaScript
        const wishlistItems = <?php echo json_encode($wishlist_products); ?>;
        
        document.addEventListener('DOMContentLoaded', () => {
            // Highlight products already in the wishlist
            wishlistItems.forEach(id => {
                const btn = document.querySelector(`.btn-addwish-b2[data-id="${id}"]`);
                if (btn) {
                    btn.classList.add('active-wishlist');
                }
            });
            
            // Add to wishlist button functionality
            document.querySelectorAll('.btn-addwish-b2').forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    const id = this.dataset.id;
                    const button = this;
                    
                    // Check if already in wishlist
                    if (button.classList.contains('active-wishlist')) {
                        // Remove from wishlist
                        fetch('remove-from-wishlist.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: 'product_id=' + encodeURIComponent(id)
                        })
                        .then(res => res.text())
                        .then(response => {
                            button.classList.remove('active-wishlist');
                            
                            // Update header count
                            const headerWishlist = document.querySelector('.icon-header-noti[href="wishlist-view.php"]');
                            if (headerWishlist) {
                                let currentCount = parseInt(headerWishlist.getAttribute('data-notify')) || 0;
                                if (currentCount > 0) {
                                    currentCount--;
                                    headerWishlist.setAttribute('data-notify', currentCount);
                                }
                            }
                            
                            // Remove from wishlistItems array
                            const index = wishlistItems.indexOf(parseInt(id));
                            if (index > -1) {
                                wishlistItems.splice(index, 1);
                            }
                            
                            swal('Removed from wishlist!');
                        });
                    } else {
                        // Add to wishlist
                        fetch('wishlist.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: 'product_id=' + encodeURIComponent(id)
                        })
                        .then(res => res.text())
                        .then(response => {
                            if (response === 'added' || response === 'exists') {
                                button.classList.add('active-wishlist');
                                
                                // Update header count
                                const headerWishlist = document.querySelector('.icon-header-noti[href="wishlist-view.php"]');
                                if (headerWishlist && response === 'added') {
                                    let currentCount = parseInt(headerWishlist.getAttribute('data-notify')) || 0;
                                    currentCount++;
                                    headerWishlist.setAttribute('data-notify', currentCount);
                                }
                                
                                // Add to wishlistItems array
                                if (response === 'added' && !wishlistItems.includes(parseInt(id))) {
                                    wishlistItems.push(parseInt(id));
                                }
                                
                                swal(response === 'added' ? 'Added to wishlist!' : 'Already in wishlist!');
                            }
                        });
                    }
                });
            });
                

            
            // Handle Quick View modal opening
            document.querySelectorAll('.show-modal-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const id = this.dataset.id;
                    fetch('get-product-details.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                        body: 'id=' + encodeURIComponent(id)
                    })
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('modal-body-content').innerHTML = data;
                        document.getElementById('productModal').style.display = 'block';
                    });
                });
            });
            
            // Handle Quick View modal closing
            document.querySelector('.modal-close').addEventListener('click', function () {
                document.getElementById('productModal').style.display = 'none';
            });
            
            window.addEventListener('click', function (e) {
                const modal = document.getElementById('productModal');
                if (e.target == modal) {
                    modal.style.display = 'none';
                }
            });
            
            // Color button click functionality
            document.querySelectorAll('.block2').forEach(productBox => {
                const frontImg = productBox.querySelector('.main-img');
                const backImg = productBox.querySelector('.back-img');
                const colorButtons = productBox.querySelectorAll('.color-btn');
                
                console.log('Product box found:', {
                    productId: productBox.getAttribute('data-product-id'),
                    frontImg: frontImg,
                    backImg: backImg,
                    colorButtonsCount: colorButtons.length
                });
                
                colorButtons.forEach((btn, index) => {
                    console.log(`Color button ${index}:`, {
                        color: btn.getAttribute('data-color'),
                        frontImg: btn.getAttribute('data-front-img'),
                        backImg: btn.getAttribute('data-back-img'),
                        isActive: btn.classList.contains('active')
                    });
                    
                    btn.addEventListener('click', (e) => {
                        e.preventDefault();
                        console.log('Color button clicked:', btn.getAttribute('data-color'));
                        
                        // Remove active class from all color buttons in this product
                        colorButtons.forEach(cb => cb.classList.remove('active'));
                        // Add active class to clicked button
                        btn.classList.add('active');
                        
                        const newFrontImg = btn.getAttribute('data-front-img');
                        const newBackImg = btn.getAttribute('data-back-img');
                        
                        console.log('Updating images:', {
                            newFrontImg: newFrontImg,
                            newBackImg: newBackImg,
                            frontImgElement: frontImg,
                            backImgElement: backImg
                        });
                        
                        // Update front image
                        if (newFrontImg && frontImg) {
                            frontImg.src = newFrontImg;
                            console.log('Front image updated to:', newFrontImg);
                        } else {
                            console.log('Could not update front image:', { newFrontImg, frontImg });
                        }
                        
                        // Update back image
                        if (newBackImg && backImg) {
                            backImg.src = newBackImg;
                            console.log('Back image updated to:', newBackImg);
                        } else {
                            console.log('Could not update back image:', { newBackImg, backImg });
                        }
                        
                        console.log('Color change completed for:', btn.getAttribute('data-color'));
                    });
                });
            });
            
            // Initialize rating system
            initRatingStars();
            

        });
        
        // Function to handle the rating stars
        function initRatingStars() {
            document.querySelectorAll('.rating-stars').forEach(container => {
                const productId = container.getAttribute('data-product-id');
                const stars = container.querySelectorAll('i');
                const hiddenInput = document.getElementById('rating-value-' + productId);
                
                // Load existing rating if available
                loadExistingRating(productId, stars);
                
                stars.forEach(star => {
                    star.addEventListener('click', function () {
                        const rating = parseInt(this.getAttribute('data-value'));
                        
                        // Update star UI
                        updateStarDisplay(stars, rating);
                        
                        if (hiddenInput) {
                            hiddenInput.value = rating;
                        }
                        
                        // Save rating to database
                        saveRatingToDatabase(productId, rating);
                    });
                    
                    // Hover effects
                    star.addEventListener('mouseenter', function() {
                        const rating = parseInt(this.getAttribute('data-value'));
                        updateStarDisplay(stars, rating);
                    });
                    
                    star.addEventListener('mouseleave', function() {
                        const currentRating = hiddenInput ? parseInt(hiddenInput.value) || 0 : 0;
                        updateStarDisplay(stars, currentRating);
                    });
                });
            });
        }
        
        // Function to update star display
        function updateStarDisplay(stars, rating) {
            stars.forEach(s => {
                const starValue = parseInt(s.getAttribute('data-value'));
                s.classList.remove('fa-star', 'fa-star-o');
                s.classList.add(starValue <= rating ? 'fa-star' : 'fa-star-o');
            });
        }
        
        // Function to load existing rating from database
        function loadExistingRating(productId, stars) {
            fetch('get-product-rating.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'product_id=' + encodeURIComponent(productId)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.rating > 0) {
                    updateStarDisplay(stars, data.rating);
                    const hiddenInput = document.getElementById('rating-value-' + productId);
                    if (hiddenInput) {
                        hiddenInput.value = data.rating;
                    }
                }
            })
            .catch(error => console.log('Error loading rating:', error));
        }
        
        // Function to save rating to database
        function saveRatingToDatabase(productId, rating) {
            fetch('save-product-rating.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'product_id=' + encodeURIComponent(productId) + '&rating=' + encodeURIComponent(rating)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Rating saved successfully!');
                    // Show success message
                    swal('Rating saved!', 'Thank you for your feedback.', 'success');
                } else {
                    console.log('Error saving rating:', data.message);
                    swal('Error', 'Could not save rating. Please try again.', 'error');
                }
            })
            .catch(error => {
                console.log('Error saving rating:', error);
                swal('Error', 'Could not save rating. Please try again.', 'error');
            });
        }
        

        

    </script>
    
</body>
</html>