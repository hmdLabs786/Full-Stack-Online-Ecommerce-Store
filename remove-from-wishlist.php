<?php
session_start();
include('connection.php');

// Use logged-in user ID if available, otherwise fallback to guest ID
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} elseif (isset($_SESSION['guest_id'])) {
    $user_id = $_SESSION['guest_id'];
} else {
    echo "Invalid request.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id']) && $user_id) {
    $product_id = intval($_POST['product_id']);

    // Remove from wishlist
    $result = mysqli_query($con, "DELETE FROM wishlist WHERE user_id = '$user_id' AND product_id = '$product_id'");
    
    if ($result) {
        // Redirect back to wishlist page instead of just echoing
        header("Location: wishlist-view.php?removed=1");
        exit();
    } else {
        header("Location: wishlist-view.php?error=1");
        exit();
    }
} else {
    header("Location: wishlist-view.php?error=2");
    exit();
}
