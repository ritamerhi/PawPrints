<?php
require_once('./backend/db_config.php');

$user = $_COOKIE['userID'];

$username = $_COOKIE['username'];

$petID = $_GET['petID'];

$petArr = $table->findSql("SELECT * FROM pets where petID= ?", [$petID]);
$pet = $petArr[0];
$locationArr = $table->findSql("SELECT location from locations where locationID = ?", [$pet['locationID']]);
$location = $locationArr[0]['location'];
$data = ['petID' => $petID, 'userID' => $user];
$recentlyViewed = $table->insert('recently_viewed', $data);



$favorite = $table->findSql("SELECT * FROM favorites WHERE petID = ? AND userID = ?", [$petID, $user]);

// Check if the favorites query returned any rows
if (!empty($favorite)) {
    echo "<script>document.addEventListener('DOMContentLoaded', function() {
        var icon = document.querySelector('.fa-heart-o'); // Adjust selector if necessary
        if (icon) {
            icon.classList.remove('fa-heart-o');
            icon.classList.add('fa-heart');
            icon.style.color = 'red'; // Optional, if you handle color changes via CSS
        }
    });</script>";
}

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Pet Details</title>
</head>



<body>
    <div class="container" style="display:block;">

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
        <main style="padding-left:10%; padding-right:10%;">
            <!--Title Of Page-->
            <section class="body_container">
                <p class="body_title">My Details</p>
            </section>

            <div style="display:flex;">
                <div class="pet_details_picture"><img src="<?= $pet['image_path'] ?>" style="margin:5%; width:90%;height: 90%; border-radius: 3%;"></div>
                <div class="pet_details_about">
                    <div class="item-container">
                        <p class="detail_title">Name: <?= htmlspecialchars($pet['name']) ?></p>
                        <button class="love-button" onclick="toggleLove(this, <?= $pet['petID'] ?>, <?= $_COOKIE['userID'] ?>)">
                            <i class="fa fa-heart-o"></i>
                        </button>
                    </div>

                    <p class="detail_subtitle">About</p>
                    <p class="detail_text">Breed: <?= $pet['breed'] ?></p>
                    <p class="detail_text">Color: <?= $pet['color'] ?></p>
                    <p class="detail_text">Age: <?= $pet['age'] ?></p>
                    <p class="detail_text">Size: <?= $pet['size'] ?></p>
                    <p class="detail_text">Location: <?= $location ?></p>
                    <?php if($pet['status']==0): ?>
    <a href="./backend/adopt.php?petID=<?= $_GET['petID'] ?>"><button class="adopt_button">Adopt</button></a>
<?php endif; ?>

                </div>
            </div>
            <div class="pet_details_description">
                <p class="detail_title">Description</p>
                <textarea id="description" name="description" class="about_entity" required rows="4" cols="50" style="margin-left: -1vw;height: 16vh;/* text-combine-upright: all; */text-align: left;width: 70vw;font-size: x-large;" readonly><?= $pet['description'] ?></textarea>
            </div>
        </main>
    </div>
    <script src="script.js"></script>
</body>

</html>

<style>
    .button-container {
        display: flex;
        justify-content: flex-end;
        /* Aligns children (the button) to the right */
        padding: 10px;
        /* Adds some space around the content */
    }

    .love-button {
        background: transparent;
        border: none;
        cursor: pointer;
        font-size: 50px;
        color: red;
        /* Default color for unfilled */
    }

    .love-button .fa {
        transition: color 0.3s ease;
        /* Smooth transition for color change */
    }
    .item-container {
    display: flex;
    align-items: center; /* Vertical alignment */
}

.love-button {
    background: transparent;
    border: none;
    cursor: pointer;
    font-size: 3.5rem; /* Adjust the font size as needed */
    color: red; /* Default color for unfilled */
    margin-right: 10px; /* Adds some space between the button and the text */
}

.item-container .detail_title {
    font-family: Noto Sans;
    color:#8F5774;
    font-size: 2.5vw;
    font-weight: 800;
    margin:0px;
    padding-bottom: 1vh;
}

</style>

<script>
    function toggleLove(button) {
        const icon = button.querySelector('.fa');
        if (icon.classList.contains('fa-heart-o')) { // If it's an empty heart
            icon.classList.remove('fa-heart-o');
            icon.classList.add('fa-heart');
            icon.style.color = 'red'; // Change to red when filled
        } else { // If it's a filled heart
            icon.classList.remove('fa-heart');
            icon.classList.add('fa-heart-o');
            icon.style.color = 'gray'; // Change to gray when empty
        }
    }



    function toggleLove(button, petID, userID) {
        const icon = button.querySelector('.fa');
        const isFilled = icon.classList.contains('fa-heart');

        // Toggle class first
        icon.classList.toggle('fa-heart');
        icon.classList.toggle('fa-heart-o');

        // Prepare data for AJAX request
        const formData = new FormData();
        formData.append('petID', petID);
        formData.append('userID', userID);

        // Make the AJAX request
        fetch('./backend/toggle_favorite.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data.status);
                icon.style.color = isFilled ? 'gray' : 'red'; // Toggle color based on action
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }
</script>