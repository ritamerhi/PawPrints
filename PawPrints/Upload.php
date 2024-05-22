<?php
require_once('./backend/db_config.php');
if (!isset($_COOKIE['userID'])) {
    echo "<script>window.location = './sign_in.php'</script>";
}
$username = $_COOKIE['username'];
$userID = $_COOKIE['userID'];
$email = $_COOKIE['email'];
$locationID = $_COOKIE['locationID'];

?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/cdbb6a3d3b.js" crossorigin="anonymous"></script>
    <link link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mogra&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>ReHome</title>
</head>

<script>
    window.onload = function() {
    // Check URL for specific query parameters
    const params = new URLSearchParams(window.location.search);
    if (params.has('alert')) {
        const alertType = params.get('alert');
        if (alertType === 'pet_saved_failed') {
            alert('Failed to add for adoption retry again:(');
        }
    }
}
</script>

<body>
    <div class="container" style="display:block;">

        <!--Header-->
        <header>
            <div style="display:flex; align-items: center;">
                <img src="images/tilted_paw.png" style="width:5vh; height:5vh;margin-top:1%;">
                <p class="header_text">PawPrints</p>
            </div>
            <div style="display:flex; min-width:90%; justify-content: end; align-items: center;">
                <button class="menu-button" id="btn"><i class="fa-solid fa-bars" style="color: #EEF3F9;"></i></button>
            </div>
            <!--Side Panel-->
            <div class="side_bar">
                <div class="menu">
                    <div style="text-align: center; margin-bottom: 3vh;">
                        <img src="images/profile.png" style="width:12vh;height:12vh; margin:0px; padding:0px;">
                        <p class="side_bar_user"><?php echo $username ?></p>
                    </div>
                    <div style="height: 60vh;">
                        <div class="side_bar_option"><a href="Home.php" class="side_bar_option_text" style="text-decoration:none;"><i class="fa-regular fa-map" style="color: #EEF3F9; padding-right:1vw;"></i>Discover</a></div>
                        <div class="side_bar_option"><a href="Search.php" class="side_bar_option_text" style="text-decoration:none;"><i class="fa-solid fa-magnifying-glass" style="color: #EEF3F9; padding-right:1vw;"></i>Search</a></div>
                        <div class="side_bar_option"><a href="Favorites.php" class="side_bar_option_text" style="text-decoration:none;"><i class="fa-regular fa-heart" style="color: #EEF3F9; padding-right:1vw;"></i>Favorites</a></div>
                        <div class="side_bar_option"><a href="Upload.php" class="side_bar_option_text" style="text-decoration:none;"><i class="fa-solid fa-plus" style="color: #EEF3F9; padding-right:1vw;"></i>Rehome</a></div>
                    </div>
                    <div>
                        <div class="side_bar_option"><a href="profile.php" class="side_bar_option_text" style="text-decoration:none;"><i class="fa-regular fa-user" style="color: #EEF3F9;padding-right:1vw;"></i>Account</a></div>
                        <div class="side_bar_option"><a href="sign_in.php" class="side_bar_option_text" style="text-decoration:none;"><i class="fa-solid fa-arrow-right-from-bracket" style="color: #EEF3F9;padding-right:1vw;"></i>Logout</a></div>
                    </div>
                </div>
            </div>
        </header>

        <!--Main Body-->
        <main>
            <!--Title Of Page-->
            <section class="body_container">
                <p class="body_title">Give Me A Home</p>
            </section>
            <form action="./backend/upload.php" method="post" enctype="multipart/form-data">
                <div style="display:flex;">
                    <div class="about_box">
                        <p class="detail_title">About</p>
                        <div style="display:flex;">
                            <div style="width:5vw">
                                <p class="detail_text">Name:</p>
                            </div>
                            <div><input type="text" id="name" name="name" class="about_entity" required></div>
                        </div>
                        <div style="display:flex;">
                            <div style="width:5vw">
                                <p class="detail_text">Species:</p>
                            </div>
                            <div><input type="text" id="species" name="species" class="about_entity" required></div>
                        </div>
                        <div style="display:flex;">
                            <div style="width:5vw">
                                <p class="detail_text">Breed:</p>
                            </div>
                            <div><input type="text" id="breed" name="breed" class="about_entity" required></div>
                        </div>
                        <div style="display:flex;">
                            <div style="width:5vw">
                                <p class="detail_text">Color:</p>
                            </div>
                            <div><input type="text" id="color" name="color" class="about_entity" required></div>
                        </div>
                        <div style="display:flex;">
                            <div style="width:5vw">
                                <p class="detail_text">Age:</p>
                            </div>
                            <div><input type="number" id="age" name="age" class="about_entity" required min="0" max="30"></div>
                        </div>

                        <div style="display:flex;">
                            <div style="width:5vw">
                                <p class="detail_text">Sex:</p>
                            </div>
                            <div class="form-group">
                                <select id="sex" name="sex" class="about_entity" style="
    height: 6.7vh;
    background-color: #EEF3F9;
    border: none;
    margin-top: 0rem;
    color: black;" required>
                                    <option value="">Select Sex</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div style="display:flex;">
                            <div style="width:5vw">
                                <p class="detail_text">Size:</p>
                            </div>
                            <div class="form-group">
                                <select id="size" name="size" class="about_entity" style="
    height: 6.7vh;
    background-color: #EEF3F9;
    border: none;
    margin-top: 0rem;
    color: black;" required>
                                    <option value="">Select Size</option>
                                    <option value="large">Large</option>
                                    <option value="medium">Medium</option>
                                    <option value="small">Small</option>
                                </select>
                            </div>
                        </div>
                        <div style="display:flex;">
                            <div style="width:5vw">
                                <p class="detail_text">Location:</p>
                            </div>
                            <div class="form-group">
                                <select id="location" name="location" class="about_entity" style="
    height: 6.7vh;
    background-color: #EEF3F9;
    border: none;
    margin-top: 0rem;
    color: black;" required>
                                    <option value="">Please select a location</option>
                                    <option value="1">Beirut</option>
                                    <option value="2">Byblos</option>
                                    <option value="3">Sidon</option>
                                    <option value="4">Tyre</option>
                                    <option value="5">Tripoli</option>
                                </select>
                            </div>
                        </div>
                        <div style="display:flex; align-items: center;">
                            <div style="width:5vw">
                                <p class="detail_text">Picture:</p>
                            </div>
                            <div class="file-upload">
                                <input type="file" id="picture" name="picture" class="about_entity_picture" accept="image/*" required>
                                <label for="picture" class="file-upload-btn">Choose Picture</label>
                            </div>
                            <div id="preview-container" style="margin-left: 20px;">
                                <img id="image-preview" style="display: none; width: 100px; height: auto;" alt="Image Preview">
                            </div>
                        </div>

                    </div>
                    <div class="description_box">
                        <p class="detail_title">Description</p>
                        <textarea id="description" name="description" class="about_entity" required rows="4" cols="50" style="
    margin-left: 0px;
    height: 80vh;
    /* text-combine-upright: all; */
    text-align: left;    font-size: x-large;
"></textarea>
                    </div>

                </div>
                <div style="margin-left:5vw;">
                    <button type="submit" class="upload_button">Put For Adoption</button>
                </div>
            </form>

        </main>
    </div>
    <script src="script.js"></script>
</body>

</html>

<style>
    .file-upload {
        position: relative;
        overflow: hidden;
        display: inline-block;
    }

    .file-upload input[type='file'] {
        font-size: 100px;
        position: absolute;
        right: 0;
        top: 0;
        opacity: 0;
    }

    .file-upload-btn {
        border: 2px solid #ccc;
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
        background-color: #f8f8f8;
        border-radius: 4px;
        margin-left: 8vw;
        margin-top: 5vh;
    }

    .file-upload-btn:hover {
        background-color: #ddd;
    }
</style>

<script>
document.getElementById('picture').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file && file.type.match('image.*')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const imgElement = document.getElementById('image-preview');
            imgElement.src = e.target.result;
            imgElement.style.display = 'block'; // Make the image visible
        };
        reader.readAsDataURL(file);
    }
});
</script>
