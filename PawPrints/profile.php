<?php
$userID = $_COOKIE['userID'] ?? '';
$email = $_COOKIE['email'] ?? '';
$username = $_COOKIE['username'] ?? '';
$locationID = $_COOKIE['locationID'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mogra&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Profile</title>
</head>
<body>
<div class="container">
    <!-- Left Side -->
    <div class="left_panel">
        <img class="paw_transparent" src="images/PawPrint.png">
        <div style="width:100%; height:50%; margin-left: 20%; margin-top:20%;">
            <p class="text_logo">Paw</p>
            <div style="display:flex;">
                <img class="paw_logo" src="images/PawPrint.png">
                <p class="text_logo">Prints</p>
            </div>
        </div>
    </div>
    <!-- Right Side -->
    <div class="right_panel"> 
        <p class="text_heading">My Account</p>
        <form action="./backend/updateProfile.php" method="post" id="signupForm">
            <div class="form-group">
                <input type="text" id="username" name="username" placeholder="Username" required value="<?php echo htmlspecialchars($username); ?>"readonly>
            </div>
            <div class="form-group">
                <input type="email" id="email" name="email" placeholder="Email" required value="<?php echo htmlspecialchars($email); ?>"readonly>
            </div>
            <div class="form-group">
                <select id="location" name="location" required>
                    <option value="">Please select a location</option>
                    <option value="1" <?php echo $locationID == "1" ? 'selected' : ''; ?>>Beirut</option>
                    <option value="2" <?php echo $locationID == "2" ? 'selected' : ''; ?>>Byblos</option>
                    <option value="3" <?php echo $locationID == "3" ? 'selected' : ''; ?>>Sidon</option>
                    <option value="4" <?php echo $locationID == "4" ? 'selected' : ''; ?>>Tyre</option>
                    <option value="5" <?php echo $locationID == "5" ? 'selected' : ''; ?>>Tripoli</option>
                </select>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password">
            </div>
            <div id="passwordError" style="color:red; display:none; margin-top: 0.5rem;">Passwords do not match!</div>
            <div class="form-group">
                <button type="submit">Done</button>
            </div>
        </form>
    </div>
</div>   
</body>
</html>
<script>
document.getElementById('signupForm').addEventListener('submit', function(event) {
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirm-password').value;
    var username = document.getElementById('username').value;
    var errorDiv = document.getElementById('passwordError');
    var errors = [];

    // Clear existing errors
    errorDiv.textContent = '';
    errorDiv.style.display = 'none';

    // Skip password checks if both password fields are empty
    if (password === '' && confirmPassword === '') {
        // Check only username requirements
        if (username.length < 3 || username.length > 15) {
            errors.push('Username must be between 3 to 15 characters.');
            errorDiv.style.display = 'block';
        }
    } else {
        // Perform all checks including password
        if (password.length < 3 || password.length > 15) {
            errors.push('Password must be between 3 to 15 characters.');
            errorDiv.style.display = 'block';
        }

        if (username.length < 3 || username.length > 15) {
            errors.push('Username must be between 3 to 15 characters.');
            errorDiv.style.display = 'block';
        }

        if (password !== confirmPassword) {
            errors.push('Passwords do not match!');
            errorDiv.style.display = 'block';
        }
    }

    // Display errors or submit form
    if (errors.length > 0) {
        errorDiv.textContent = errors.join(' ');
        event.preventDefault(); // Prevent form from submitting
    }
});

// Optional: Validate in real-time to provide immediate feedback
document.getElementById('confirm-password').addEventListener('input', function() {
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirm-password').value;
    var errorDiv = document.getElementById('passwordError');

    // Clear the error message if password fields are empty
    if (password === '' && confirmPassword === '') {
        errorDiv.textContent = '';
        errorDiv.style.display = 'none';
        return; // Exit the function early
    }

    // Check if passwords match and meet length requirements
    if (password === confirmPassword && password.length >= 3 && password.length <= 15) {
        errorDiv.textContent = '';
        errorDiv.style.display = 'none';
    } else {
        if (password !== confirmPassword) {
            errorDiv.textContent = 'Passwords do not match!';
            errorDiv.style.display = 'block';
        }
        if (password.length < 3 || password.length > 15) {
            errorDiv.textContent = 'Password must be between 3 to 15 characters.';
            errorDiv.style.display = 'block';
        }
    }
});


</script>