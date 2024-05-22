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
    <title>Thank You!</title>
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
            <p class="body_title">Thank You for Adopting</p>
        </section>
        <div class="note">
            <div style="height: 90%; width: 100%; " >An email message has been sent to the “owner” waiting for them to confirm the adoption. They will contact you soon.</div>
            <div style="justify-items: end;align-items: end; text-align: end;"><a href="Home.php"><button class="go_back">Go Back To Discover</button></a></div>
        </div>
    </main>
</div>
<script src="script.js"></script>
</body>
</html>