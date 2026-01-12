<?php
session_start();
include('connection.php');

header('Content-Type: application/json');

// Check if user is logged in or has guest session
$user_id = $_SESSION['user_id'] ?? $_SESSION['guest_id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'] ?? null;
    
    if ($product_id && $user_id) {
        $product_id = mysqli_real_escape_string($con, $product_id);
        $user_id = mysqli_real_escape_string($con, $user_id);
        
        // Get user's rating for this product
        $rating_query = "SELECT rating FROM product_ratings WHERE product_id = '$product_id' AND user_id = '$user_id'";
        $rating_result = mysqli_query($con, $rating_query);
        
        if ($rating_result && $row = mysqli_fetch_assoc($rating_result)) {
            echo json_encode(['success' => true, 'rating' => (int)$row['rating']]);
        } else {
            echo json_encode(['success' => true, 'rating' => 0]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid product ID or user']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

mysqli_close($con);
?>
