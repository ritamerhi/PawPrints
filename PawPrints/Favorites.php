<?php
require_once('./backend/db_config.php');  
$username = $_COOKIE['username'];
$favoriteAnimals = $table->findSql("SELECT petID from favorites where userID = ?",[$_COOKIE['userID']]);
$petIDs = [];

foreach($favoriteAnimals as $pet){
  $petIDs[]= $pet['petID'];
}
$animals = $table->findByIds('pets',$petIDs)

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
    <title>Favroites</title>
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
                    <p class="side_bar_user"><?php echo $username?></p>
                </div>
                <div style="height: 60vh;">
                    <div class="side_bar_option"><a href="Home.php" class="side_bar_option_text" style="text-decoration:none;"><i class="fa-regular fa-map" style="color: #EEF3F9; padding-right:1vw;"></i>Discover</a></div>
                    <div class="side_bar_option"><a href="Search.php" class="side_bar_option_text" style="text-decoration:none;"><i class="fa-solid fa-magnifying-glass" style="color: #EEF3F9; padding-right:1vw;"></i>Search</a></div>
                    <div class="side_bar_option"><a href="Favorites.php" class="side_bar_option_text" style="text-decoration:none;"><i class="fa-regular fa-heart" style="color: #EEF3F9; padding-right:1vw;"></i>Favorites</a></div>
                    <div class="side_bar_option"><a href="Upload.php" class="side_bar_option_text" style="text-decoration:none;"><i class="fa-solid fa-plus" style="color: #EEF3F9; padding-right:1vw;"></i>Rehome</a></div>
                </div>
                <div>
                    <div class="side_bar_option"><a href="profile.php" class="side_bar_option_text" style="text-decoration:none;"><i class="fa-regular fa-user" style="color: #EEF3F9;padding-right:1vw;"></i>Account</a></div>
                   <div class="side_bar_option"><a href="sign_in.php"class="side_bar_option_text" style="text-decoration:none;"><i class="fa-solid #EEF3F9;padding-right:1vw;"></i>Logout</a></div>
                </div>     
          </div>
        </div>
      </header>

    <!--Main Body-->
    <main>
        <!--Title Of Page-->
        <section class="body_container">
            <p class="body_title">Your Favorites</p>
        </section>
        <section class="favorites_box">
            <!--to replicate-->
            <?php foreach($animals as $pet){ ?>
                    <button class="details_button" href="PetDetails.php">
                    <a href="PetDetails.php?petID=<?=$pet['petID']?>" style="text-decoration: none;"> 
                    <div class="scroll_box_content">
                        <img src="<?= htmlspecialchars($pet['image_path']) ?>" style="width:80%; height: 70%; margin-top: 9%; border-radius: 3%;">
                      <div class="inner_scroll_box_content"> 
                      <p class="pet_name"><?= htmlspecialchars($pet['name']) ?></p>
                <p class="pet_view"><?= htmlspecialchars($pet['breed']) . " - " . htmlspecialchars($pet['age']) ?></p>
                      </div>
                    </div>
                    </a>
                  </button>  
                    

                  <?php } ?>
              <!--till here--> 
        </section>
    </main>
</div>
<script src="script.js"></script>
</body>
</html>