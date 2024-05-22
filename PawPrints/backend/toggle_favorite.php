<?php
require('db_config.php');

$petID = $_POST['petID'];
$userID = $_POST['userID'];

// Check if this favorite already exists

$favorite = $table->findSql("SELECT * FROM favorites WHERE petID = ? AND userID = ?",[$petID,$userID]);

if ($favorite) {
    // If exists, remove it
$favorite = $table->findSql("DELETE FROM favorites WHERE petID = ? AND userID = ?",[$petID,$userID]);

} else {
    // If not exists, add it
$favorite = $table->insert("favorites",['petID'=> $petID,'userID'=>$userID]);
}
?>
