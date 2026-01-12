<?php 
include("connection.php"); 
session_start();

$uid = $_SESSION['uid'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Your Orders</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS Links -->
    <link rel="icon" type="image/png" href="images/icons/zufelogo-removebg-preview.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
        .order-section {
            padding: 40px 0 60px;
            background-color: #f8f9fa;
        }

        .order-card {
            background: #fff;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .order-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(0,0,0,0.1);
        }

        .order-img {
            width: 100%;
            max-width: 100px;
            border-radius: 8px;
            object-fit: cover;
        }

        .order-title {
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 8px;
            color: #333;
        }

        /* Ensure heading is not covered by mobile header */
        .ltext-105 {
            margin-top: 0;
            padding-top: 0;
        }

        .order-detail {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 4px;
        }

        .order-meta {
            text-align: center;
            font-size: 14px;
            color: #666;
        }

        .order-meta div {
            margin-bottom: 5px;
        }

        .order-price {
            font-weight: 700;
            font-size: 16px;
            color: #000;
            text-align: right;
        }

        .bottom-actions {
            text-align: right;
            margin-top: 30px;
        }

        .bottom-actions .subtotal {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 18px;
        }

        .bottom-actions .btn {
            background-color: #321961;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-size: 14px;
            margin-left: 10px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .bottom-actions .btn:hover {
            background-color: #22124e;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(50, 25, 97, 0.3);
        }

        /* Empty cart styling */
        .empty-cart {
            text-align: center;
            padding: 60px 20px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.05);
        }

        .empty-cart-icon {
            font-size: 64px;
            color: #ccc;
            margin-bottom: 20px;
        }

        .empty-cart h3 {
            color: #666;
            margin-bottom: 15px;
            font-size: 24px;
        }

        .empty-cart p {
            color: #999;
            margin-bottom: 30px;
            font-size: 16px;
        }

        .btn-continue-shopping {
            background: linear-gradient(135deg, #321961, #4a2b8a);
            color: white;
            border: none;
            border-radius: 25px;
            padding: 15px 30px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(50, 25, 97, 0.2);
        }

        .btn-continue-shopping:hover {
            background: linear-gradient(135deg, #4a2b8a, #321961);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(50, 25, 97, 0.3);
            color: white;
            text-decoration: none;
        }

        /* Mobile Responsiveness */
        @media screen and (max-width: 767px) {
            .order-section {
                padding: 80px 0 40px; /* Increased top padding to account for mobile header */
                margin-top: 0;
            }

            .order-card {
                padding: 20px 15px;
                margin-bottom: 15px;
            }

            .order-img {
                max-width: 80px;
                margin-bottom: 15px;
            }

            .order-title {
                font-size: 16px;
                margin-bottom: 10px;
            }

            .order-detail {
                font-size: 13px;
                margin-bottom: 6px;
            }

            .order-meta {
                text-align: left;
                margin: 15px 0;
            }

            .order-price {
                text-align: left;
                margin-top: 15px;
            }

            .bottom-actions {
                text-align: center;
                margin-top: 25px;
            }

            .bottom-actions .btn {
                display: block;
                width: 100%;
                margin: 10px 0;
                text-align: center;
                padding: 15px 20px;
                font-size: 16px;
            }

            .empty-cart {
                padding: 40px 20px;
                margin: 20px 0;
            }

            .empty-cart-icon {
                font-size: 48px;
            }

            .empty-cart h3 {
                font-size: 20px;
            }

            .btn-continue-shopping {
                width: 100%;
                padding: 18px 20px;
                font-size: 16px;
            }
        }

        /* Small mobile devices */
        @media screen and (max-width: 480px) {
            .order-section {
                padding: 70px 0 40px; /* Slightly less padding for very small screens */
            }
            
            .order-card {
                padding: 15px 12px;
            }

            .order-img {
                max-width: 70px;
            }

            .order-title {
                font-size: 15px;
            }

            .order-detail {
                font-size: 12px;
            }

            .order-meta {
                font-size: 12px;
            }

            .order-price {
                font-size: 14px;
            }
        }

        /* Touch-friendly improvements for mobile */
        @media screen and (max-width: 767px) {
            .order-card a {
                min-height: 44px;
                min-width: 44px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .order-card i.fas {
                font-size: 20px;
            }

            .btn-continue-shopping:active {
                transform: scale(0.98);
            }

            /* Ensure heading is properly spaced from mobile header */
            .ltext-105 {
                margin-top: 20px;
                padding-top: 0;
                position: relative;
                z-index: 1;
            }
            
            /* Ensure mobile menu is properly styled */
            .menu-mobile {
                position: fixed;
                top: 70px;
                left: 0;
                width: 100%;
                background: #fff;
                border-top: 1px solid #e6e6e6;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                z-index: 1000;
                max-height: calc(100vh - 70px);
                overflow-y: auto;
            }
            
            .menu-mobile ul {
                list-style: none;
                margin: 0;
                padding: 0;
            }
            
            .menu-mobile li {
                border-bottom: 1px solid #f0f0f0;
            }
            
            .menu-mobile a {
                display: block;
                padding: 15px 20px;
                color: #333;
                text-decoration: none;
                font-size: 16px;
                transition: background-color 0.2s ease;
            }
            
            .menu-mobile a:hover {
                background-color: #f8f9fa;
                color: #321961;
            }
            
            .sub-menu-m {
                background-color: #f8f9fa;
                display: none;
            }
            
            .sub-menu-m li {
                border-bottom: none;
            }
            
            .sub-menu-m a {
                padding-left: 40px;
                font-size: 14px;
                color: #666;
            }
            
            .arrow-main-menu-m {
                float: right;
                margin-top: 5px;
                transition: transform 0.3s ease;
            }
            
            .turn-arrow-main-menu-m {
                transform: rotate(180deg);
            }
            
            /* Ensure mobile menu toggle button is visible */
            .btn-show-menu-mobile {
                display: block !important;
                cursor: pointer;
                z-index: 1001;
            }
        }
    </style>
</head>
<body class="animsition">

<?php include("header.php"); ?>

<!-- Orders Section -->
<section class="order-section">
    <div class="container">
        <h2 class="ltext-105 text-dark txt-center mb-4">Shopping Basket</h2>

        <?php
        $subtotal = 0;
        $subtotal = 0;

// Collect product IDs from DB to avoid duplicates
$db_cart_ids = [];
$checkQuery = mysqli_query($con, "SELECT proid FROM cart WHERE (uid='$uid' OR session_id='" . session_id() . "') AND tracking_number IS NULL");
while ($row = mysqli_fetch_assoc($checkQuery)) {
    $db_cart_ids[] = $row['proid'];
}

        // Show Cart Items First (from session)
       // Show Cart Items First (from session)
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    foreach ($_SESSION['cart'] as $key => $item) {
        if (in_array($item['proid'], $db_cart_ids)) {
            continue; // skip session item if it's already in DB
        }
        $totalPrice = $item['proprice'] * $item['proqty'];
        $subtotal += $totalPrice;

        ?>
        <div class="order-card">
            <div class="row align-items-center">
                <div class="col-md-2 col-4">
                    <img src="adminpanel3/img/<?php echo $item['proimg']; ?>" class="order-img" alt="Product Image">
                </div>
                <div class="col-md-4 col-8">
                    <div class="order-title"><?php echo $item['proname']; ?></div>
                    <div class="order-detail">Size: <?php echo $item['selected_size'] ?? 'N/A'; ?></div>
                    <div class="order-detail">Color: <?php echo $item['selected_color'] ?? 'N/A'; ?></div>
                    <div class="order-detail">Qty: <?php echo $item['proqty']; ?></div>
                </div>
                <div class="col-md-3 text-center mt-3 mt-md-0">
                    <div class="order-meta">
                        <div>Status: <span class="text-warning">In Cart</span></div>
                        <div>—</div>
                    </div>
                </div>
                <div class="col-md-3 text-end mt-3 mt-md-0">
                    <div class="order-price d-flex justify-content-end align-items-center" style="gap: 12px;">
                        <span>PKR <?php echo number_format($totalPrice); ?></span>
                        <a href="delete_order.php?index=<?php echo $key; ?>" onclick="return confirm('Remove item from cart?')" class="text-decoration-none">
                            <i class="fas fa-trash-alt text-danger" style="font-size: 18px;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
            }
        }

        // Show Placed Orders
// Show Cart Items from DB
$query = mysqli_query($con, "SELECT * FROM cart WHERE (uid='$uid' OR session_id='" . session_id() . "') AND tracking_number IS NULL ORDER BY id DESC");
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $totalOrder = $row['proprice'] * $row['proqty'];
        $subtotal += $totalOrder;
?>
        <div class="order-card">
            <div class="row align-items-center">
                <div class="col-md-2 col-4">
                    <img src="adminpanel3/img/<?php echo $row['proimg']; ?>" class="order-img" alt="Product Image">
                </div>
                <div class="col-md-4 col-8">
                    <div class="order-title"><?php echo $row['proname']; ?></div>
                    <div class="order-detail">Size: <?php echo $row['selected_size'] ?? 'N/A'; ?></div>
                    <div class="order-detail">Color: <?php echo $row['selected_color'] ?? 'N/A'; ?></div>
                    <div class="order-detail">Qty: <?php echo $row['proqty']; ?></div>
                </div>
                <div class="col-md-3 text-center mt-3 mt-md-0">
                    <div class="order-meta">
                        <div>Status: <span class="text-warning">In Cart</span></div>
                        <div>Date: <?php echo date("Y-m-d", strtotime($row['created_at'])); ?></div>
                    </div>
                </div>
                <div class="col-md-3 text-end mt-3 mt-md-0">
                    <div class="order-price d-flex justify-content-end align-items-center" style="gap: 12px;">
                        <span>PKR <?php echo number_format($totalOrder); ?></span>
                        <a href="delete_order.php?proid=<?php echo $row['proid']; ?>" onclick="return confirm('Remove item from cart?')" class="text-decoration-none">
                            <i class="fas fa-trash-alt text-danger" style="font-size: 18px;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}


        if ($subtotal == 0) {
            echo '<div class="empty-cart">
                    <div class="empty-cart-icon">
                        <i class="fas fa-shopping-basket"></i>
                    </div>
                    <h3>Your Shopping Basket is Empty</h3>
                    <p>Looks like you haven\'t added any items to your cart yet.<br>Start shopping to discover amazing products!</p>
                    <a href="index.php" class="btn btn-continue-shopping">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Continue Shopping
                    </a>
                  </div>';
        }
        ?>

        <?php if ($subtotal > 0): ?>
        <hr>
        <div class="bottom-actions">
            <div class="subtotal">Subtotal: <span>PKR <?php echo number_format($subtotal); ?></span>
            <small class="text-muted"><p>Taxes & shipping calculated at checkout</p></small>
        </div>
                                    <div><a href="shoping-cart.php" class="btn btn-primary">Checkout</a></div>
                        <div><a href="index.php" class="btn btn-secondary mt-2">Continue Shopping</a></div>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php include("footer.php"); ?>

<!-- Scripts -->
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

<script>
// Mobile enhancements for your_orders.php
document.addEventListener('DOMContentLoaded', function() {
    
    // Add touch feedback for mobile
    if ('ontouchstart' in window) {
        const orderCards = document.querySelectorAll('.order-card');
        orderCards.forEach(card => {
            card.addEventListener('touchstart', function() {
                this.style.transform = 'scale(0.98)';
            });
            
            card.addEventListener('touchend', function() {
                this.style.transform = 'scale(1)';
            });
        });
    }
    
    // Improve mobile button interactions
    const buttons = document.querySelectorAll('.btn, .btn-continue-shopping');
    buttons.forEach(btn => {
        btn.addEventListener('touchstart', function() {
            this.style.transform = 'scale(0.95)';
        });
        
        btn.addEventListener('touchend', function() {
            this.style.transform = 'scale(1)';
        });
    });
    
    // Add smooth scrolling for mobile
    if ('ontouchstart' in window) {
        document.documentElement.style.scrollBehavior = 'smooth';
    }
    
    // Mobile-specific optimizations
    if (window.innerWidth <= 767) {
        // Ensure proper spacing on mobile to account for fixed header
        const orderSection = document.querySelector('.order-section');
        if (orderSection) {
            orderSection.style.paddingTop = '80px'; // Account for mobile header height
            orderSection.style.paddingBottom = '40px';
        }
        
        // Ensure heading is not covered by mobile header
        const heading = document.querySelector('.ltext-105');
        if (heading) {
            heading.style.marginTop = '20px';
            heading.style.paddingTop = '0';
            heading.style.position = 'relative';
            heading.style.zIndex = '1';
        }
        
        // Optimize images for mobile
        const orderImages = document.querySelectorAll('.order-img');
        orderImages.forEach(img => {
            img.style.maxWidth = '80px';
            img.style.height = 'auto';
        });
    }
    
    // Ensure mobile menu functionality works
    const mobileMenuToggle = document.querySelector('.btn-show-menu-mobile');
    const mobileMenu = document.querySelector('.menu-mobile');
    

    
    if (mobileMenuToggle && mobileMenu) {
        // Mobile menu toggle functionality
        mobileMenuToggle.addEventListener('click', function() {
            this.classList.toggle('is-active');
            if (mobileMenu.style.display === 'block') {
                mobileMenu.style.display = 'none';
            } else {
                mobileMenu.style.display = 'block';
            }
        });
        
        // Handle submenu arrows
        const arrowMainMenu = document.querySelectorAll('.arrow-main-menu-m');
        arrowMainMenu.forEach(arrow => {
            arrow.addEventListener('click', function() {
                const subMenu = this.parentElement.querySelector('.sub-menu-m');
                if (subMenu) {
                    if (subMenu.style.display === 'block') {
                        subMenu.style.display = 'none';
                    } else {
                        subMenu.style.display = 'block';
                    }
                }
                this.classList.toggle('turn-arrow-main-menu-m');
            });
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!mobileMenuToggle.contains(e.target) && !mobileMenu.contains(e.target)) {
                mobileMenu.style.display = 'none';
                mobileMenuToggle.classList.remove('is-active');
            }
        });
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 992) {
                mobileMenu.style.display = 'none';
                mobileMenuToggle.classList.remove('is-active');
                
                // Reset submenus
                const subMenus = document.querySelectorAll('.sub-menu-m');
                subMenus.forEach(subMenu => {
                    subMenu.style.display = 'none';
                });
                
                const arrows = document.querySelectorAll('.arrow-main-menu-m');
                arrows.forEach(arrow => {
                    arrow.classList.remove('turn-arrow-main-menu-m');
                });
            }
        });
    }
});
</script>
</body>
</html>
