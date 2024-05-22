<?php
require('db_config.php');
// Make sure data is received
if (isset($_POST['username'])) {
    $username = $_POST['username'];
}
if (isset($_POST['email'])) {
    $email = $_POST['email'];
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
}
if (isset($_POST['location'])) {
    $location = $_POST['location'];
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
}

// Check if username already exists in database
$fetchemail = $table->findSql("SELECT email FROM users WHERE email = ?", [$email]);
if (!empty($fetchemail)) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'email already taken.'
    ]);
    header('Location: /PawPrints/sign_up.php?alert=email_taken');
    exit();
}
$fetchUsername = $table->findSql("SELECT username FROM users WHERE username = ?", [$username]);
if (!empty($fetchUsername)) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'username already taken.'
    ]);
    header('Location: /PawPrints/sign_up.php?alert=username_taken');

    exit();
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert new user into database
$insertResult = $table->insert('users', [
    'username' => $username,
    'email' => $email,
    'locationID' => $location,
    'password' => $hashedPassword
]);

if ($insertResult) {

    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'message' => 'Welcome to PAW PRINTS'
    ]);
    header('Location: http://localhost/PawPrints/sign_in.php');
    exit();
    }
  
 else {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'Error creating user.'
    ]);
    exit();
}
