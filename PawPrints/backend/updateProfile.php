<?php
require('db_config.php');

// Make sure email and location are received; password is optional
if (!isset($_POST['email'], $_POST['location'])) {
    // Not all necessary data was received
    header('Location: /PawPrints/sign_up.php?alert=data_missing');
    exit();
}

$email = $_POST['email'];
$location = $_POST['location'];

// Prepare data for update
$data = ['locationID' => $location];

// Check if a new password was provided
if (!empty($_POST['password'])) {
    $password = $_POST['password'];
    // Hash the new password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    // Add hashed password to data array
    $data['password'] = $hashedPassword;
}

// Perform the update
$updateSuccess = $table->update('users', $data, "email = ?", [$email]);

if ($updateSuccess) {
    // Success response or redirect
    setcookie('locationID', $location, time() + (86400 * 30), "/");

    header('Location: /PawPrints/home.php?alert=profile_update_success');
    exit();
} else {
    // Error response or redirect
    header('Location: /PawPrints/profile.php?alert=update_failed');
    exit();
}
?>
