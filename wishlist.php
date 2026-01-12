<?php
session_start();
include('connection.php');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log the request for debugging
error_log("Wishlist request received - Method: " . $_SERVER['REQUEST_METHOD'] . ", POST data: " . print_r($_POST, true));

// Use logged-in user ID if available, otherwise fallback to guest ID
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    error_log("Using logged-in user ID: " . $user_id);
} elseif (!isset($_SESSION['guest_id'])) {
    $_SESSION['guest_id'] = rand(100000, 999999); // temp guest user ID
    $user_id = $_SESSION['guest_id'];
    error_log("Created new guest ID: " . $user_id);
} else {
    $user_id = $_SESSION['guest_id'];
    error_log("Using existing guest ID: " . $user_id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);
    error_log("Processing product ID: " . $product_id);

    // Check if product already exists in wishlist
    $check = mysqli_query($con, "SELECT * FROM wishlist WHERE user_id='$user_id' AND product_id=$product_id");
    
    if (!$check) {
        error_log("Check query failed: " . mysqli_error($con));
        echo "error";
        exit();
    }

    if (mysqli_num_rows($check) > 0) {
        error_log("Product already in wishlist");
        echo "exists";
    } else {
        // Insert new product into wishlist
        $insert = mysqli_query($con, "INSERT INTO wishlist(user_id, product_id) VALUES('$user_id', $product_id)");
        
        if ($insert) {
            error_log("Product successfully added to wishlist");
            echo "added";
        } else {
            error_log("Wishlist Insert Error: " . mysqli_error($con));
            echo "error";
        }
    }
} else {
    error_log("Invalid request - Method: " . $_SERVER['REQUEST_METHOD'] . ", Product ID: " . (isset($_POST['product_id']) ? $_POST['product_id'] : 'not set'));
    echo "error";
}
?>
