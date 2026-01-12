<?php
session_start();
include('connection.php');

header('Content-Type: application/json');

// Check if user is logged in or has guest session
$user_id = $_SESSION['user_id'] ?? $_SESSION['guest_id'] ?? null;

if (!$user_id) {
    // Create guest session if none exists
    if (!isset($_SESSION['guest_id'])) {
        $_SESSION['guest_id'] = 'guest_' . uniqid() . '_' . time();
    }
    $user_id = $_SESSION['guest_id'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'] ?? null;
    $rating = $_POST['rating'] ?? null;
    
    if ($product_id && $rating && is_numeric($rating) && $rating >= 1 && $rating <= 5) {
        $product_id = mysqli_real_escape_string($con, $product_id);
        $rating = mysqli_real_escape_string($con, $rating);
        $user_id = mysqli_real_escape_string($con, $user_id);
        
        // Check if rating already exists for this user and product
        $check_query = "SELECT id FROM product_ratings WHERE product_id = '$product_id' AND user_id = '$user_id'";
        $check_result = mysqli_query($con, $check_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            // Update existing rating
            $update_query = "UPDATE product_ratings SET rating = '$rating', updated_at = NOW() WHERE product_id = '$product_id' AND user_id = '$user_id'";
            if (mysqli_query($con, $update_query)) {
                echo json_encode(['success' => true, 'message' => 'Rating updated successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error updating rating: ' . mysqli_error($con)]);
            }
        } else {
            // Insert new rating
            $insert_query = "INSERT INTO product_ratings (product_id, user_id, rating, created_at, updated_at) VALUES ('$product_id', '$user_id', '$rating', NOW(), NOW())";
            if (mysqli_query($con, $insert_query)) {
                echo json_encode(['success' => true, 'message' => 'Rating saved successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error saving rating: ' . mysqli_error($con)]);
            }
        }
        
        // Update average rating for the product
        updateProductAverageRating($con, $product_id);
        
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid rating data']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

// Function to update product average rating
function updateProductAverageRating($con, $product_id) {
    $avg_query = "SELECT AVG(rating) as avg_rating, COUNT(*) as total_ratings FROM product_ratings WHERE product_id = '$product_id'";
    $avg_result = mysqli_query($con, $avg_query);
    
    if ($avg_result && $row = mysqli_fetch_assoc($avg_result)) {
        $avg_rating = round($row['avg_rating'], 2);
        $total_ratings = $row['total_ratings'];
        
        // Update products table with average rating
        $update_product_query = "UPDATE products SET avg_rating = '$avg_rating', total_ratings = '$total_ratings' WHERE id = '$product_id'";
        mysqli_query($con, $update_product_query);
    }
}

mysqli_close($con);
?>
