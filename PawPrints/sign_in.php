<?php
setcookie('email', '', time() - 3600, "/");
setcookie('username', '', time() - 3600, "/");
setcookie('locationID', '', time() - 3600, "/");
setcookie('userID', '', time() - 3600, "/");

?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mogra&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Sign In</title>
</head>


<script>
window.onload = function() {
    // Check URL for specific query parameters
    const params = new URLSearchParams(window.location.search);
    if (params.has('alert')) {
        const alertType = params.get('alert');
        if (alertType === 'invalid_cred') {
            alert('Invalid email or password.');
        }
    }
}
</script>
<body>
<div class="container">

    <!--Left Side-->
    <div class="left_panel">
        <img class= "paw_transparent" src="images/PawPrint.png">
        <div style="width:100%; height:50%; margin-left: 20%; margin-top:20%;">
            <p class="text_logo" >Paw</p>
            <div style="display:flex;">
                <img class= "paw_logo" src="images/PawPrint.png">
                <p class="text_logo">Prints</p>
            </div>
        </div>
    </div>


    <!--Right Side-->
    <div class="right_panel"> 
        <p class="text_logo" style="color:#1D3F58; font-size:4vw;"> Welcome</p>
        <p class="text_heading"> Log in to your account</p>
        <form action="./backend/login.php" method="post">
            <div class="form-group">
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <div>
                <p class="text_heading" style="color:#001B2E; font-weight:400; font-size: 1.1vw; padding-top: 2%;">Dont have an account? <a href="sign_up.php" style="text-decoration: underline; color:#8F5774">sign up</a></p>
            </div>
            <div class="form-group">
                <button type="submit">Log in</button>
            </div>
        </form>
    </div>
</div>   
</div>
</body>
</html>
