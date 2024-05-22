<?php
require('db_config.php');
$username = $_COOKIE['username'];
// Make sure email and location are received; password is optional
if (!isset($_POST['review'])) {
    // Not all necessary data was received
    header('Location: /PawPrints/home.php?alert=data_missing');
    exit();
}

$review = $_POST['review'];

// Prepare data for update
$data = ['review' => $review, 'username'=>$username];

// Check if a 
// Perform the update
$insertReview = $table->insert('reviews', $data);

if ($insertReview) {
    // Success response or redirect
    header('Location: /PawPrints/home.php?alert=insert_review_success');
    exit();
} else {
    // Error response or redirect
    header('Location: /PawPrints/profile.php?alert=update_failed');
    exit();
}
?>
