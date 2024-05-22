<?php
require_once('db_config.php');
$password = $_POST['password'];
$email = $_POST['email'];
// Validate the request data
if (empty($email) || empty($password)) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'Please enter your email and password.'
    ]);
    exit();
}



$user = $table->findSql("SELECT * from users where email = '$email'");
    $id = $user[0]['userID'];

if (empty($user)) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'Invalid email or password.'
    ]);
    header('Location: /PawPrints/sign_in.php?alert=invalid_cred');
    exit();
}



if (password_verify($password, $user[0]['password'])) {
    setcookie('email', $email, time() + (86400 * 30), "/");
    setcookie('username', $user[0]['username'], time() + (86400 * 30), "/");
    setcookie('locationID', $user[0]['locationID'], time() + (86400 * 30), "/");
    setcookie('userID', $user[0]['userID'], time() + (86400 * 30), "/");

    header('Location: /PawPrints');
    exit();

} else {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'Invalid email or password.'
    ]);
    header('Location: /PawPrints/sign_in.php?alert=invalid_cred');
    exit();
}
