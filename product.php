<?php
session_start();
include('connection.php');

// Show all errors for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Redirect back if search is empty
if (isset($_GET['search']) && empty(trim($_GET['search']))) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

// Fetch user's wishlist products
$wishlist_products = [];
if (isset($_SESSION['user_id'])) {
    $uid = $_SESSION['user_id'];
    $wishlist_q = mysqli_query($con, "SELECT product_id FROM wishlist WHERE user_id = $uid");
    while ($w = mysqli_fetch_assoc($wishlist_q)) {
        $wishlist_products[] = $w['product_id'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icons/zufelogo-removebg-preview.png"/>
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/mobile-fixes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .search-container {
            text-align: center;
            margin: 100px 0 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }
        .search-form {
            display: inline-flex;
            align-items: center;
            position: relative;
            max-width: 500px;
            width: 100%;
        }
        .search-input {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 50px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s;
        }
        .search-input:focus {
            border-color: #007bff;
        }
        .search-button {
            position: absolute;
            right: 5px;
            padding: 10px 15px;
            background-color: #007bff;
            border: none;
            border-radius: 50%;
            color: white;
            font-size: 18px;
            cursor: pointer;
        }
        .search-button:hover {
            background-color: #0056b3;
        }
        .back-button {
            padding: 10px 15px;
            background-color: #f0f0f0;
            border-radius: 50px;
            color: #007bff;
            font-size: 16px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        .back-button:hover {
            background-color: #e0e0e0;
        }
        .color-circle {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid transparent;
            transition: 0.2s ease;
        }
        .btn-addwish-b2 .icon-heart1 {
            filter: grayscale(100%);
            transition: filter 0.3s ease;
        }
        .btn-addwish-b2:hover .icon-heart1,
        .btn-addwish-b2.active-wishlist .icon-heart1 {
            filter: sepia(1) saturate(700%) hue-rotate(265deg) brightness(0.4);
        }
        .btn-addwish-b2 {
            cursor: pointer;
        }
        .rating-stars {
            display: flex;
            gap: 5px;
            margin-top: 5px;
            cursor: pointer;
            font-size: 13px;
            color: #ccc;
        }
        .rating-stars .fa-star {
            color: #c2711aff;
        }
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
        .image-container:hover .main-img {
            opacity: 0;
        }
        .image-container:hover .back-img {
            opacity: 1;
        }
        .color-btn.active {
            border: 2px solid #333 !important;
            transform: scale(1.1);
        }
        .color-btn:hover {
            transform: scale(1.1);
            border-color: #333 !important;
        }
        
        /* Rating Stars Styling */
        .rating-stars {
            display: flex;
            gap: 5px;
            margin-top: 10px;
            cursor: pointer;
            font-size: 16px;
            color: #ccc;
        }
        
        .rating-stars i {
            transition: all 0.2s ease;
            cursor: pointer;
        }
        
        .rating-stars i:hover {
            transform: scale(1.2);
        }
        
        .rating-stars .fa-star { 
            color: #c2711aff; 
        }
        
        .rating-stars .fa-star-o { 
            color: #ccc; 
        }
    </style>
</head>
<body class="animsition">

    <!-- <?php include('header.php'); ?> -->

    <div class="search-container">
        <a style="color: #310E68 !important;" href="javascript:history.back()" class="back-button">
            <i style="color: #310E68 !important;" class="fa fa-arrow-left"></i> Back
        </a>
        <form action="product.php" method="GET" class="search-form">
            <input type="text" name="search" class="search-input" placeholder="Search for products..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" required>
            <button style="background-color: #310E68 !important;" type="submit" class="search-button"><i class="fa fa-search"></i></button>
        </form>
    </div>

    <?php
    $cat_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($cat_id > 0) {
        $cat_query = mysqli_query($con, "SELECT cat_name FROM categories WHERE id = $cat_id");
        if ($cat_query && mysqli_num_rows($cat_query) > 0) {
            $cat_row = mysqli_fetch_assoc($cat_query);
            echo "<h1 class='text-center ltext-103 cl5 mb-4'>" . htmlspecialchars($cat_row['cat_name']) . "</h1>";
        } else {
            echo "<h2 class='text-center text-danger mb-4'>Invalid Category</h2>";
        }
    }
    ?>

    <div class="bg0 m-t-23 p-b-140">
        <div class="container">
            <div class="row isotope-grid">
                <?php
                $search_query = isset($_GET['search']) ? trim($_GET['search']) : '';
                $cat_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

                if ($search_query !== '') {
                    $pro = mysqli_query($con, "SELECT * FROM `products` WHERE name LIKE '%$search_query%'");
                } elseif ($cat_id > 0) {
                    $pro = mysqli_query($con, "SELECT * FROM `products` WHERE cat_id = $cat_id");
                } else {
                    $pro = mysqli_query($con, "SELECT * FROM `products`");
                }

                while ($row = mysqli_fetch_array($pro)) {
                    $sizes = explode(',', $row['sizes']);
                    $colors = explode(',', $row['colors']);

                    // Fetch color images
                    $product_id = $row['id'];
                    $color_imgs = mysqli_query($con, "SELECT * FROM product_images WHERE product_id = $product_id");
                    $color_image_map = [];
                    while ($imgrow = mysqli_fetch_assoc($color_imgs)) {
                        $color = strtolower(trim($imgrow['color']));
                        $type = strtolower(trim($imgrow['type']));
                        if (!isset($color_image_map[$color])) {
                            $color_image_map[$color] = [];
                        }
                        $color_image_map[$color][$type] = $imgrow['image'];
                    }
                ?>
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <?php
                            // Determine initial front and back image
                            $defaultFront = $row['image'];
                            $defaultBack = $row['image'];
                            if (!empty($colors)) {
                                $first_color = strtolower(trim($colors[0]));
                                if (isset($color_image_map[$first_color]['front'])) {
                                    $defaultFront = $color_image_map[$first_color]['front'];
                                }
                                if (isset($color_image_map['']['back'])) {
                                    $defaultBack = $color_image_map['']['back'];
                                } elseif (isset($color_image_map[$first_color]['back'])) {
                                    $defaultBack = $color_image_map[$first_color]['back'];
                                } else {
                                    $defaultBack = $defaultFront;
                                }
                            }
                            ?>
                            <a href="product-detail.php?proid=<?php echo $row['id']; ?>">
                                <div class="image-container">
                                    <img src="adminpanel3/img/<?php echo $defaultFront; ?>" alt="Front Image" class="product-image main-img current-front">
                                    <img src="adminpanel3/img/<?php echo $defaultBack; ?>" alt="Back Image" class="product-image back-img current-back">
                                </div>
                            </a>
                            <button class="block2-btn show-modal-btn block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04" data-id="<?php echo $row['id']; ?>">
                                Quick View
                            </button>
                        </div>
                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l">
                                <span class="stext-105 cl3" style="font-weight: bold;"><?php echo $row['name']; ?></span>
                                <span class="stext-105 cl3 mt-2"><?php echo $row['description']; ?></span>
                                <span class="stext-105 cl3 mt-2" style="font-weight: bold;">Rs: <?php echo $row['price']; ?></span>
                                <span class="stext-104 cl3 mt-2">
                                    <b>Sizes:
                                        <?php foreach ($sizes as $size) {
                                            echo "<span style='margin-right:5px;'>$size</span>";
                                        } ?>
                                    </b>
                                </span>
                                <div style="margin-top: 5px;">
                                    <?php foreach ($colors as $color):
                                        $color_trim = strtolower(trim($color));
                                        $front = $color_image_map[$color_trim]['front'] ?? $row['image'];
                                        $back  = $color_image_map[$color_trim]['back'] ?? $front;
                                    ?>
                                    <button class="color-btn color-circle"
                                        style="background: <?php echo $color ?>; border: 1px solid #ccc; width: 15px; height: 15px; margin: 2px; cursor:pointer;"
                                        title="<?php echo $color ?>"
                                        data-front-img="adminpanel3/img/<?php echo htmlspecialchars($front) ?>"
                                        data-back-img="adminpanel3/img/<?php echo htmlspecialchars($back) ?>">
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
                                <a href="#" class="btn-addwish-b2 js-addwish-b2" data-id="<?php echo $row['id']; ?>">
                                    <i class="fa fa-heart icon-heart1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    
    <div id="productModal" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); z-index:9999;">
        <div class="modal-content" style="background: white; margin: 60px auto; padding: 20px; width: 90%; max-width: 400px; border-radius: 8px; position: relative;">
            <span class="close" style="position:absolute; top:10px; right:15px; font-size:25px; cursor:pointer; color:#888;">&times;</span>
            <div id="modal-body-content"></div>
        </div>
    </div>

    <?php include("footer.php"); ?>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="js/main.js"></script>

    <script>
        const wishlistItems = <?php echo json_encode($wishlist_products); ?>;

        document.addEventListener('DOMContentLoaded', () => {
            // Highlight already wishlisted products
            console.log('Initial wishlist items:', wishlistItems);
            wishlistItems.forEach(id => {
                const btn = document.querySelector(`.btn-addwish-b2[data-id="${id}"]`);
                if (btn) {
                    btn.classList.add('active-wishlist');
                    console.log('Added active-wishlist to product', id, 'button classes:', btn.className);
                    
                    // Force a repaint to ensure CSS is applied
                    btn.offsetHeight;
                } else {
                    console.log('Button not found for product', id);
                }
            });

            // Add/Remove from wishlist with toggle functionality
            const wishlistButtons = document.querySelectorAll('.btn-addwish-b2');
            console.log('Found wishlist buttons:', wishlistButtons.length);
            console.log('Wishlist buttons:', wishlistButtons);
            
            // Check if buttons have the correct data-id attribute
            wishlistButtons.forEach((btn, index) => {
                console.log(`Button ${index}:`, {
                    element: btn,
                    dataset: btn.dataset,
                    hasDataId: btn.hasAttribute('data-id'),
                    dataId: btn.getAttribute('data-id'),
                    classes: btn.className,
                    innerHTML: btn.innerHTML
                });
            });
            
            wishlistButtons.forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    console.log('Wishlist button clicked!');
                    console.log('Event type:', e.type);
                    console.log('Is mobile:', window.innerWidth <= 767);
                    console.log('Touch supported:', 'ontouchstart' in window);
                    console.log('Button element:', this);
                    console.log('Button classes:', this.className);
                    console.log('Button HTML:', this.outerHTML);
                    
                    const id = this.dataset.id;
                    const button = this;
                    
                    console.log('Product ID from dataset:', id);
                    console.log('Button dataset:', this.dataset);
                    
                    if (button.classList.contains('active-wishlist')) {
                        // Remove from wishlist
                        console.log('Removing from wishlist, product ID:', id);
                        fetch('remove-from-wishlist.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: 'product_id=' + encodeURIComponent(id)
                        })
                        .then(res => {
                            console.log('Raw remove response:', res);
                            return res.text();
                        })
                        .then(response => {
                            console.log('Remove response text:', response);
                            console.log('Remove response length:', response.length);
                            if (response === 'removed') {
                                button.classList.remove('active-wishlist');
                                console.log('Removed active-wishlist class, button classes:', button.className);
                                
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
                            } else {
                                console.error('Failed to remove from wishlist:', response);
                                swal('Error removing from wishlist!');
                            }
                        })
                        .catch(error => {
                            console.error('Error removing from wishlist:', error);
                            swal('Error removing from wishlist!');
                        });
                    } else {
                        // Add to wishlist
                        console.log('Adding to wishlist, product ID:', id);
                        console.log('Session cookies:', document.cookie);
                        console.log('User agent:', navigator.userAgent);
                        console.log('Is mobile:', window.innerWidth <= 767);
                        
                        fetch('wishlist.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: 'product_id=' + encodeURIComponent(id)
                        })
                        .then(res => {
                            console.log('Raw response:', res);
                            console.log('Response status:', res.status);
                            console.log('Response ok:', res.ok);
                            console.log('Response headers:', res.headers);
                            console.log('Response URL:', res.url);
                            console.log('Response type:', res.type);
                            return res.text();
                        })
                        .then(response => {
                            console.log('Add response text:', response);
                            console.log('Response length:', response.length);
                            console.log('Response type:', typeof response);
                            console.log('Is mobile:', window.innerWidth <= 767);
                            console.log('Response comparison with "added":', response === 'added');
                            console.log('Response comparison with "exists":', response === 'exists');
                            console.log('Response trimmed:', response.trim());
                            console.log('Response char codes:', Array.from(response).map(c => c.charCodeAt(0)));
                            
                            if (response === 'added' || response === 'exists') {
                                                                button.classList.add('active-wishlist');
                                console.log('Added active-wishlist class, button classes:', button.className);

                                // Force a repaint to ensure CSS is applied immediately
                                button.offsetHeight;
                                
                                // Update header count
                                const headerWishlist = document.querySelector('.icon-header-noti[href="wishlist-view.php"]');
                                if (headerWishlist) {
                                    let currentCount = parseInt(headerWishlist.getAttribute('data-notify')) || 0;
                                    if (response === 'added') {
                                        currentCount++;
                                        headerWishlist.setAttribute('data-notify', currentCount);
                                    }
                                }

                                // Add to wishlistItems array
                                if (response === 'added' && !wishlistItems.includes(parseInt(id))) {
                                    wishlistItems.push(parseInt(id));
                                }

                                swal(response === 'added' ? 'Added to wishlist!' : 'Already in wishlist!');
                            } else {
                                console.error('Failed to add to wishlist:', response);
                                swal('Error adding to wishlist!');
                            }
                        })
                        .catch(error => {
                            console.error('Error adding to wishlist:', error);
                            console.error('Error name:', error.name);
                            console.error('Error message:', error.message);
                            console.error('Error stack:', error.stack);
                            console.error('Is mobile:', window.innerWidth <= 767);
                            console.error('User agent:', navigator.userAgent);
                            console.error('Session status:', document.cookie);
                            swal('Error adding to wishlist!');
                        });
                    }
                });
            });

            // Quick View Modal logic
            document.querySelectorAll('.show-modal-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const id = this.dataset.id;
                    fetch('get-product-details.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: 'id=' + encodeURIComponent(id)
                    })
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('modal-body-content').innerHTML = data;
                        document.getElementById('productModal').style.display = 'block';
                        // Re-initialize rating inside modal
                        initRatingStars();
                    });
                });
            });

            // Close modal
            const closeModalBtn = document.querySelector('#productModal .close');
            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', () => {
                    document.getElementById('productModal').style.display = 'none';
                });
            }

            // Click outside to close modal
            window.addEventListener('click', function (e) {
                const modal = document.getElementById('productModal');
                if (e.target === modal) {
                    modal.style.display = 'none';
                }
            });

            // Color button image switch (with hover back image)
            document.querySelectorAll('.block2').forEach(productBox => {
                const frontImg = productBox.querySelector('.current-front');
                const backImg = productBox.querySelector('.current-back');
                const colorButtons = productBox.querySelectorAll('.color-btn');
                colorButtons.forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        e.preventDefault();
                        // Remove active class
                        colorButtons.forEach(cb => cb.classList.remove('active'));
                        btn.classList.add('active');
                        const newFrontImg = btn.getAttribute('data-front-img');
                        const newBackImg = btn.getAttribute('data-back-img');
                        if (frontImg && newFrontImg) {
                            frontImg.src = newFrontImg;
                        }
                        if (backImg && newBackImg) {
                            backImg.src = newBackImg;
                        }
                    });
                });
            });

            // Initialize rating on load
            initRatingStars();

            // Function: Rating system
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
        });
    </script>
    
</body>
</html>