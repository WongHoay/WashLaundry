<?php
// login.php

// Start the session
session_start();

// Dummy data for demonstration purposes
$valid_username = "testuser";
$valid_password = "testpass";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Validate the credentials
    if ($username == $valid_username && $password == $valid_password) {
        // Set the session variable
        $_SESSION['username'] = $username;
        
        // Redirect to the user profile page
        header("Location: /WashLaundry/HTML/userprofile.php");
        exit();
    } else {
        // Invalid credentials
        echo "<script>alert('Invalid username or password. Please try again.');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Log In</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/login.css"/>
    </head>
    <body>
    <div class="title">
        <h2>Log In</h2>
    </div>
    <div class="login-container">
        <div class="login-form">
            <form action="login.php" method="post">
                <div class="login-input">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter username">
                </div>
                <div class="login-input">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter password">
                </div>
                <button type="submit">LOGIN</button>
                &nbsp;
            </form>
<!--            <div class="password">
                <a href="#">Forgot password?</a>
            </div>-->
            <div class="signup">
                <p>Don't have an account? <a href="/WashLaundry/HTML/signup.php" class="button">Sign Up</a></p>
                <a href="homepage.php" class="button home">HomePage</a>
            </div>
        </div>
    </div>
</body>
</html>
