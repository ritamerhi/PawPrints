<?php
require_once('./backend/db_config.php');  
if (!isset($_COOKIE['userID'])) {
  echo "<script>window.location = './sign_in.php'</script>";
}
$username = $_COOKIE['username'];
$userID = $_COOKIE['userID'];
$email = $_COOKIE['email'];
$locationID = $_COOKIE['locationID'];

$newAdopt = $table->findSql("SELECT * FROM pets where status=0");
$petsNearYou = $table->findSql("SELECT * FROM pets where status=0 and locationID = ?",[$locationID]);
$recentlyViewed = $table->findSql(
  "SELECT userID, petID, MAX(timestamp) AS most_recent_view
   FROM recently_viewed
   WHERE userID = ?
   GROUP BY userID, petID
   ORDER BY most_recent_view DESC",
  [$userID]
);

$recentPetID = [];

foreach($recentlyViewed as $pet){
  $recentPetID[]= $pet['petID'];
}

$recentPets = $table->findByIds('pets', $recentPetID);

$reviews = $table->findSql("SELECT * FROM reviews");

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
    <title>Home</title>
</head>


<script>
window.onload = function() {
    // Check URL for specific query parameters
    const params = new URLSearchParams(window.location.search);
    if (params.has('alert')) {
        const alertType = params.get('alert');
        if (alertType === 'profile_update_success') {
            alert('Profile updated successfully.');
        }
        if (alertType === 'pet_saved_success') {
            alert('Pet added successfully for adoption.');
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
      <a class="navigation_text" href="files/When_to_see_a_veterinarian.pdf" target="_blank" style="text-decoration: none;">Articles</a>

          <a class="navigation_text" href="#review" style="text-decoration: none;">Review</a>
          <a class="navigation_text" href="files/PET_CARE_BASICS.pdf" target="_blank" style="text-decoration: none;">About us</a>
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
                  <div class="side_bar_option"><a href="sign_in.php"class="side_bar_option_text" style="text-decoration:none;"><i class="fa-solid fa-arrow-right-from-bracket" style="color: #EEF3F9;padding-right:1vw;"></i>Logout</a></div>
              </div>     
        </div>
      </div>
    </header>

    <!--Main Body-->
    <main>
        <!--Title Of Page-->
        <section class="body_container">
          <p class="body_title">Discover Love. Adopt A Pet</p>
        </section>
        <!--New To Adopt Box-->
        <section class="home_box">
                <div style="display:flex;background-color: #001B2E;">
                    <p class="navigation_text">New To Adopt</p>
                </div>
                <!--Scroll Through Data-->
                <div class="body_data">
                <div class="scroll_box">
                  
                  <!--to replicate-->
                  <?php foreach($newAdopt as $pet){ ?>
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
                </div>
            </div>
        </section>

        <!--Pets Near You Box-->
        <section class="home_box">
          <div style="display:flex;background-color: #001B2E;">
              <p class="navigation_text">Pets Near You</p>
          </div>
          <!--Scroll Through Data-->
          <div class="body_data">
          <div class="scroll_box">
            
                 <!--to replicate-->
                 <?php foreach($petsNearYou as $pet){ ?>
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
          </div>
          </div>
         </section>
        
          <!--Recently Viewed Box-->
        <section class="home_box">
          <div style="display:flex;background-color: #001B2E;">
              <p class="navigation_text">Recently Viewed</p>
          </div>
          <!--Scroll Through Data-->
          <div class="body_data">
          <div class="scroll_box">
            
            <!--to replicate-->
            <?php foreach($recentPets as $pet){ ?>
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
          </div>
          </div>
        </section>


        <section class="filling" id="review"></section>
        <!--Review Box-->
        <section class="home_box" id="review">
          <div style="display:flex;background-color: #8F5774;">
              <p class="navigation_text">Reviews</p>
          </div>
          <div class="body_data">
              <div class="scroll_box">
              <?php foreach($reviews as $review){ ?>
                <button class="details_button"> 
                      <div class="scroll_box_content">
                          <div class="inner_scroll_box_content" style="height:47vh"> 
                              <p class="pet_name"><?=$review['username']?></p>
                              <p class="pet_view"><?=$review['review']?></p>
                          </div>
                      </div>
                  </button>  
                    

                  <?php } ?>

                
              </div>
          </div>
          
          <div style="text-align: end;">
              <button class="review_button" onclick="document.getElementById('reviewForm').style.display='block'">Leave Us a Review</button>
          </div>
          <div id="reviewForm">
              <form action="./backend/submit_review.php" method="post">
                  <label for="review">Your Review:</label>
                  <textarea id="review" name="review" required></textarea>
                  <input type="submit" value="Submit Review">
              </form>
          </div>
      </section>
      
      
        
    </main>
</div>
<script src="script.js"></script>
</body>
</html>
