<!--//// Dummy data for demonstration purposes
//$valid_username = "testuser";
//$valid_password = "testpass";-->
<?php
// login.php
include "dbFunction.php";
// Start the session
session_start();

//$username = "";
//if (isset($_COOKIE['username'])) {
//    $username = $_COOKIE['username'];
//}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    // Validate the credentials
    if (!empty($username) && !empty($password)) {
        //Establish the database connection
        $conn= dbConnect();
        
        // Prepare a select statement
        $sql = "SELECT username, password FROM user WHERE username = ?";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = $username;
           
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Store result
                $stmt->store_result();
                
                // Check if username exists, if yes then verify password
                if ($stmt->num_rows == 1) {
                    // Bind result variables
                    $stmt->bind_result($username, $hashed_password);
                    if ($stmt->fetch()) {
                        if (SHA1($password) == $hashed_password) {
                            // Password is correct, start a new session
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["username"] = $username;                            

                            // Redirect to user profile page
                            header("Location: /WashLaundry/HTML/userprofile.php");
                            exit();
                        } else {
                            // Display an error message if password is not valid
                            echo "<script>alert('Invalid username or password. Please try again.');</script>";
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
                    echo "<script>alert('Invalid username or password. Please try again.');</script>";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    } else {
        echo "<script>alert('Please enter both username and password.');</script>";
    }

    // Close connection
    $conn->close();
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
                <!--&nbsp;-->
                <br />
            </form>
            <!-- <div class="password">
                <a href="#">Forgot password?</a>
            </div> -->
            <div class="signup">
                <p>Don't have an account? <a href="/WashLaundry/HTML/signup.php" class="button">Sign Up</a></p>
                <a href="homepage.php" class="button home">HomePage</a>
            </div>
        </div>
    </div>
</body>
</html>
