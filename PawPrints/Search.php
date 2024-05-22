<?php
require_once('./backend/db_config.php');
if (!isset($_COOKIE['userID'])) {
    echo "<script>window.location = './sign_in.php'</script>";
}
$username = $_COOKIE['username'];
$userID = $_COOKIE['userID'];
$email = $_COOKIE['email'];
$locationID = $_COOKIE['locationID'];

$speciesList  = $table->findSql("SELECT DISTINCT species FROM pets ORDER BY species");
$breedList = $table->findSql("SELECT DISTINCT breed FROM pets ORDER BY breed");
$colorList = $table->findSql("SELECT DISTINCT color FROM pets ORDER BY color");
if(isset($_GET['petIds']) && !empty($_GET['petIds'])){
    $petIDs = $_GET['petIds'];
    $petArr = explode(",", trim($petIDs));
    $petList = $table->findByIds("pets", $petArr);
} else {
    $petList = $table->findSql("SELECT * FROM pets");
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
    <title>Pet Details</title>
</head>



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
        <main style="padding-left:10%; padding-right:10%;">

            <!--Title Of Page-->
            <section class="body_container">
                <p class="body_title">Find Your Pawfect Match</p>
            </section>

            <form action="./backend/search.php" method="get" class="search-form">
                <div class="horizontal_search">
                    <div style="width:20%; height:100%;">
                        <p class="search_title">Species</p>
                        <select name="species" class="search_options">
                            <option value="">Any</option>
                            <?php foreach ($speciesList as $species) : ?>
                                <option value="<?= htmlspecialchars($species['species']) ?>"><?= htmlspecialchars($species['species']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div style="width:20%; height:100%;">
                        <p class="search_title">Breed</p>
                        <select name="breed" class="search_options">
                            <option value="">Any</option>
                            <?php foreach ($breedList as $breed) : ?>
                                <option value="<?= htmlspecialchars($breed['breed']) ?>"><?= htmlspecialchars($breed['breed']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div style="width:20%; height:100%;">
                        <p class="search_title">Color</p>
                        <select name="color" class="search_options">
                            <option value="">Any</option>
                            <?php foreach ($colorList as $color) : ?>
                                <option value="<?= htmlspecialchars($color['color']) ?>"><?= htmlspecialchars($color['color']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div style="width:20%; height:100%;">
                            <p class="search_title">Size</p>
                            <select name="size" class="search_options">
                                <option value="">Any</option>
                                <option value="Large">Large</option>
                                <option value="Medium">Medium</option>
                                <option value="Small">Small</option>
                            </select>
                        </div>
                        <div style="width:20%; height:100%;">
                            <p class="search_title">Age</p>
                            <select name="age" class="search_options">
                                <option value="">Any</option>
                                <option value="0-1">0-1 year</option>
                                <option value="1-5">1-5 years</option>
                                <option value="5+">5+ years</option>
                            </select>
                        </div>
                        <div style="width:20%; height:100%;">
                            <p class="search_title">Sex</p>
                            <select name="gender" class="search_options">
                                <option value="">Any</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div style="width:20%; height:100%;">
                            <p class="search_title">Location</p>
                            <select name="locationID" class="search_options">
                                <option value="">Any</option>
                                <option value="1">Beirut</option>
                                <option value="2">Byblos</option>
                                <option value="3">Sidon</option>
                                <option value="4">Tyre</option>
                                <option value="5">Tripoli</option>
                            </select>
                        </div>
                    <div style="width:20%; height:100%;">
                    <button type="button" class="reset_button" onclick="window.location.href = 'search.php';">Reset</button>

                    </div>
                    <div style="width:20%; height:100%;">
                        <button type="submit" class="search_button">Search</button>
                    </div>
                </div>
               

            </form>

            <div class="search_result">
                <!--to replicate-->
                <?php foreach($petList as $pet){ ?>
                <button class="details_button" style="width:30%; height:50vh;">
                    <a href="PetDetails.php?petID=<?=$pet['petID']?>" style="text-decoration: none;">
                        <div class="scroll_box_content">
                            <img src="<?=$pet['image_path']?>" style="width:80%; height: 70%; margin-top: 9%; border-radius: 3%;">
                            <div class="inner_scroll_box_content">
                                <p class="pet_name"><?=$pet['name']?></p>
                                <p class="pet_view"><?=$pet['breed']?>-<?=$pet['age']?></p>
                            </div>
                        </div>
                    </a>
                </button>
                <?php } ?>
                <!--till here-->
            </div>

    </div>
    </main>
    </div>
    <script src="script.js"></script>
    
</body>

</html>