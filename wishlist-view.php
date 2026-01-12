<?php
session_start();
include('connection.php');

// ✅ User ya Guest ID
$user_id = $_SESSION['user_id'] ?? $_SESSION['guest_id'] ?? null;

// ✅ Agar guest_id set nahi hai toh naya generate karo
if (!$user_id) {
    $_SESSION['guest_id'] = rand(100000, 999999);
    $user_id = $_SESSION['guest_id'];
}

// ✅ Wishlist aur Product join karke ek hi query chalao
$q = mysqli_query($con, "
    SELECT p.* FROM wishlist w 
    JOIN products p ON p.id = w.product_id 
    WHERE w.user_id = '$user_id'
");

?>

<!DOCTYPE html>
<html>
<head>
    <title>My Wishlist</title>
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
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/mobile-fixes.css">
    <style>
        .wishlist-card {
            border: 1px solid #e0e0e0; 
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            background: white;
            height: 100%;
        }
        
        .wishlist-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
        }
        
        .wishlist-card img {
            max-width: 100%;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }
        
        .wishlist-card:hover img {
            transform: scale(1.02);
        }
        
        .wishlist-title {
            color: #310E68;
            font-weight: 600;
            margin-bottom: 30px;
        }
        
        .empty-wishlist-card {
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(49, 14, 104, 0.1);
            border: none;
        }
        
        .empty-wishlist-card .card-body {
            padding: 60px 40px;
        }
        
        .empty-wishlist-card h1 {
            color: #310E68;
            font-weight: 600;
        }
        
        .empty-wishlist-card h5 {
            color: #666;
        }
        
        .btn-continue-shopping {
            background: linear-gradient(135deg, #310E68, #9473ca) !important;
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            color: white !important;
            text-decoration: none !important;
            display: inline-block !important;
            border-radius: 8px !important;
            text-align: center !important;
        }
        
        .btn-continue-shopping:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(49, 14, 104, 0.3);
            color: white !important;
            text-decoration: none !important;
        }
        
        .btn-view-product {
            background: linear-gradient(135deg, #310E68, #9473ca) !important;
            border: none;
            font-weight: 600;
            transition: all 0.3s ease;
            color: white !important;
            text-decoration: none !important;
            display: inline-block !important;
            border-radius: 8px !important;
            text-align: center !important;
            padding: 12px 20px !important;
        }
        
        .btn-view-product:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(49, 14, 104, 0.3);
            color: white !important;
            text-decoration: none !important;
        }
        
        .btn-remove-wishlist {
            background: linear-gradient(135deg, #9473ca, #b8a9d9) !important;
            border: none;
            font-weight: 600;
            transition: all 0.3s ease;
            color: white !important;
            text-decoration: none !important;
            display: inline-block !important;
            border-radius: 8px !important;
            text-align: center !important;
            padding: 12px 20px !important;
            cursor: pointer !important;
        }
        
        .btn-remove-wishlist:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(148, 115, 202, 0.3);
            color: white !important;
            text-decoration: none !important;
        }
        
        .product-price {
            color: #310E68;
            font-size: 18px;
            font-weight: 700;
        }
        
        .product-name {
            color: #333;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        /* Alert styling */
        .alert {
            border-radius: 12px;
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        
        .alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
            border-left: 4px solid #28a745;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #721c24;
            border-left: 4px solid #dc3545;
        }
        
        .alert i {
            margin-right: 8px;
        }
        
        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .wishlist-card {
                padding: 15px;
                margin-bottom: 15px;
            }
            
            .empty-wishlist-card .card-body {
                padding: 40px 20px;
            }
            
            .wishlist-title {
                font-size: 28px;
                margin-bottom: 20px;
            }
            
            .btn-continue-shopping,
            .btn-view-product,
            .btn-remove-wishlist {
                padding: 10px 20px;
                font-size: 14px;
            }
        }
    </style>
</head>
<?php include("header.php"); ?>
<body>
    <div class="container">
        <?php 
        // Show success/error messages
        if (isset($_GET['removed']) && $_GET['removed'] == '1') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle"></i> Item removed from wishlist successfully!
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                  </div>';
        }
        if (isset($_GET['error'])) {
            $errorMsg = '';
            switch($_GET['error']) {
                case '1': $errorMsg = 'Failed to remove item from wishlist.'; break;
                case '2': $errorMsg = 'Invalid request.'; break;
                default: $errorMsg = 'An error occurred.'; break;
            }
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle"></i> ' . $errorMsg . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                  </div>';
        }
        ?>
        
        <?php if (mysqli_num_rows($q) == 0): ?>
            <div class="row justify-content-center align-items-center" style="min-height: 60vh;">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card empty-wishlist-card">
                        <div class="card-body text-center">
                            <div class="mb-4">
                                <i class="fa fa-heart-o" style="font-size: 64px; color: #310E68; opacity: 0.3;"></i>
                            </div>
                            <h1 class="card-title mb-3">Nothing In Your Wishlist</h1>
                            <h5 class="card-subtitle mb-4 text-muted">We Are Here To Serve You...</h5>
                                                            <a href="index.php" class="text-white btn-continue-shopping">
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="text-center mb-5">
                <h1 class="wishlist-title">Your Wishlist</h1>
                <p class="text-muted">You have <?php echo mysqli_num_rows($q); ?> item<?php echo mysqli_num_rows($q) > 1 ? 's' : ''; ?> in your wishlist</p>
            </div>
            
            <div class="row">
                <?php while ($row = mysqli_fetch_assoc($q)) { ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="wishlist-card">
                            <div class="text-center mb-3">
                                <a href="product-detail.php?proid=<?php echo $row['id']; ?>">
                                    <img src="adminpanel3/img/<?php echo $row['image']; ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="img-fluid">
                                </a>
                            </div>
                            
                            <h5 class="product-name"><?php echo htmlspecialchars($row['name']); ?></h5>
                            <p class="product-price mb-3">Rs. <?php echo number_format($row['price']); ?></p>

                            <div class="d-flex gap-2 mt-auto">
                                <a href="product-detail.php?proid=<?php echo $row['id']; ?>" class="btn-view-product flex-fill">
                                    Buy Now
                                </a>
                                <form action="remove-from-wishlist.php" method="POST" class="flex-fill">
                                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn-remove-wishlist w-100">
                                        Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php endif; ?>
    </div>

    </div>
        <?php include("footer.php"); ?>
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

<script>
    // Add smooth animations for wishlist cards
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.wishlist-card');
        
        // Add fade-in animation
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                card.style.transition = 'all 0.6s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
        
        // Add confirmation for remove button
        const removeButtons = document.querySelectorAll('form[action="remove-from-wishlist.php"]');
        removeButtons.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Are you sure you want to remove this item from your wishlist?')) {
                    e.preventDefault();
                }
            });
        });
        
        // Auto-hide alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => {
                    alert.remove();
                }, 500);
            }, 5000);
        });
    });
</script>

</body>
</html>
