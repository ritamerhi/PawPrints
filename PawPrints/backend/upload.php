<?php
require_once 'db_config.php'; // Ensure you include your database configuration file

$targetDir = "pets_images/";
$originalName = basename($_FILES["picture"]["name"]);
$imageFileType = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

// Generate a unique name for the image file to prevent overwrite
$uniqueFileName = uniqid('IMG_', true) . '.' . $imageFileType;
$targetFile = $targetDir . $uniqueFileName;

$uploadOk = 1;

// Check if image file is an actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["picture"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check file size
if ($_FILES["picture"]["size"] > 500000) {  // 500KB size limit
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Path variable to store in the database
$imagePath = null;

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFile)) {
        echo "The file " . htmlspecialchars($uniqueFileName) . " has been uploaded.";
        $imagePath = "./backend/" . $targetFile;

        // Insert data into the database
        $name = $_POST['name'];
        $species = $_POST['species'];
        $breed = $_POST['breed'];
        $color = $_POST['color'];
        $age = $_POST['age'];
        $gender = $_POST['sex'];
        $size = $_POST['size'];
        $location = $_POST['location'];
        $description = $_POST['description'];

        $petData = [
            'userID' => $_COOKIE['userID'],
            'name' => $name,
            'species' => $species,
            'breed' => $breed,
            'color' => $color,
            'age' => $age,
            'gender' => $gender,
            'size' => $size,
            'locationID' => $location,
            'description' => $description,
            'image_path' => $imagePath
        ];

        try {
            $result = $table->insert('pets', $petData);
            if ($result) {
                header('Location: /PawPrints/Home.php?alert=pet_saved_success');
                exit();
            } else {
                header('Location: /PawPrints/upload.php?alert=pet_saved_failed');
                echo "Failed to save pet data.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
