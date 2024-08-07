<?php
include "dbFunction.php";
// Start the session
session_start();

// Variables to store form data and error messages
$username = $email = $contact = $password = $address = ""; 
$username_err = $email_err = $contact_err = $password_err = $address_err = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate contact
    if (empty(trim($_POST["contact"]))) {
        $contact_err = "Please enter a contact number.";
    } else {
        $contact = trim($_POST["contact"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } else {
        $password = trim($_POST["password"]);
    }
    
    // Validate address
    if (empty(trim($_POST["address"]))) {
        $address_err = "Please enter a address.";
    } else {
        $address = trim($_POST["address"]);
    }

    // Check for errors before inserting in database
    if (empty($username_err) && empty($email_err) && empty($contact_err) && empty($password_err) && empty($address_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO user (username, email, contact, password, address) VALUES (?, ?, ?, ?, ?)";
        
        $conn= dbConnect();

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssss", $param_username, $param_email, $param_contact, $param_password, $param_address);

            // Set parameters
            $param_username = $username;
            $param_email = $email;
            $param_contact = $contact;
            // Create a password hash
            //$param_password = password_hash($password, PASSWORD_DEFAULT);
            //$param_password = $password;
            $param_password = sha1($password);
            $param_address = $address;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to login page
                header("Location: login.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sign Up</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/signup.css"/>
        <script src="signup.js"></script>
    </head>
    <body class="head">
        <h1>Sign Up</h1>
        
        <div class="signup-container">
            <form id="signupForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="signup-input">
                    <table class="signup-input-form">
                        <h2>Register Form</h2>
                        <a href="homepage.php" class="button home">Direct to HomePage</a>     
                        <p>Please fill in the form for registration.</p>
                        <tr>
                            <td>
                                <label for="username">Username</label>
                            </td>
                            <td>
                                <input type="text" id="username" name="username" placeholder="Enter username" value="<?php echo htmlspecialchars($username); ?>">
                                <span class="error"><?php echo $username_err; ?></span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="email">Email</label>
                            </td>
                            <td>
                                <input type="text" id="email" name="email" placeholder="Enter email" value="<?php echo htmlspecialchars($email); ?>">
                                <span class="error"><?php echo $email_err; ?></span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="contact">Phone Number</label>
                            </td>
                            <td>
                                <input type="tel" id="contact" name="contact" placeholder="Enter contact" value="<?php echo htmlspecialchars($contact); ?>">
                                <span class="error"><?php echo $contact_err; ?></span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="password">Password</label>
                            </td>
                            <td>
                                <input type="password" id="password" name="password" placeholder="Enter password" value="<?php echo htmlspecialchars($password); ?>">
                                <span class="error"><?php echo $password_err; ?></span>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <label for="address">Address</label>
                            </td>
                            <td>
                                <input type="address" id="address" name="address" placeholder="Enter address" value="<?php echo htmlspecialchars($address); ?>">
                                <span class="error"><?php echo $address_err; ?></span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <button type="submit">Submit</button>
                                <button type="button" onclick="confirmReset()">Cancel</button>
                                
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    </body>
</html>