<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mogra&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Sign Up</title>
</head>


<script>
window.onload = function() {
    // Check URL for specific query parameters
    const params = new URLSearchParams(window.location.search);
    if (params.has('alert')) {
        const alertType = params.get('alert');
        if (alertType === 'email_taken') {
            alert('Email already taken.');
        }
        if (alertType === 'username_taken') {
            alert('Username already taken.');
        }
    }
}
</script>
<body>
    <div class="container">

        <!--Left Side-->
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


        <!--Right Side-->   
        <div class="right_panel">
            <p class="text_heading"> Create a new account</p>
            <form action="./backend/signup.php" method="post" id="signupForm">
                <div class="form-group">
                    <input type="text" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <select id="location" name="location" required>
                        <option value="">Please select a location</option>
                        <option value="1">Beirut</option>
                        <option value="2">Byblos</option>
                        <option value="3">Sidon</option>
                        <option value="4">Tyre</option>
                        <option value="5">Tripoli</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password" required>
                </div>
                <div id="passwordError" style="color:red; display:none; margin-top: 0.5rem;">Passwords do not match!</div>

                <div>
                    <p class="text_heading" style="color:#001B2E; font-weight:400; font-size: 1.1vw; padding-top: 2%; ">Already have an account? <a href="sign_in.php" style="text-decoration: underline; color:#8F5774">sign in</a></p>
                </div>
                <div class="form-group">
                    <button type="submit">Sign up</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</body>

</html>
<script>
document.getElementById('signupForm').addEventListener('submit', function(event) {
    var password = document.getElementById('password').value;
    var username = document.getElementById('username').value;
    var confirmPassword = document.getElementById('confirm-password').value;
    var errorDiv = document.getElementById('passwordError');
    var errors = [];

    // Check if password length is within the specified range
    if (password.length < 3 || password.length > 15) {
        errors.push('Password must be between 3 to 15 characters.');
        errorDiv.style.display = 'block';
    }
    if (username.length < 3 || username.length > 15) {
        errors.push('Username must be between 3 to 15 characters.');
        errorDiv.style.display = 'block';
    }

    // Check if passwords match
    if (password !== confirmPassword) {
        errors.push('Passwords do not match!');
        errorDiv.style.display = 'block';
    }

    // Display errors or submit form
    if (errors.length > 0) {
        errorDiv.textContent = errors.join(' ');
        event.preventDefault(); // Prevent form from submitting
    } else {
        errorDiv.textContent = '';
    }
});

// Optional: Validate in real-time to provide immediate feedback
document.getElementById('confirm-password').addEventListener('input', function() {
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirm-password').value;
    var errorDiv = document.getElementById('passwordError');

    if (password === confirmPassword && password.length >= 3 && password.length <= 15) {
        errorDiv.textContent = '';
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