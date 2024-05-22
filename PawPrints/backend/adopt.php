<?php
require('db_config.php');

$petID = $_GET['petID'];


// Prepare data for update
$data = ['status' => 1];


// Perform the update
$updateSuccess = $table->update('pets', $data, "petID = ?", [$petID]);

if ($updateSuccess) {

    header('Location: /PawPrints/Thankyou.php');
    exit();
} else {
    // Error response or redirect
    header('Location: /PawPrints/PetDetails.php?alert=update_failed');
    exit();
}
?>
