<?php
// Start the session
session_start();

// Placeholder for fetching user data from a database
// Assume you have a function `getUserData` that fetches user data based on session or some identifier
function getUserData($username) {
    // Dummy data for demonstration
    return [
        "username" => "Amli Lee",
        "email" => "ammlee@gmail.com",
        "phone" => "014 456-4540",
        "address" => "No2, Jalan Seri Pina 5, 11600 Penang"
    ];
}

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch user data
$userData = getUserData($_SESSION['username']);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Profile page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/userprofile.css"/>
        <link rel="stylesheet" href="../CSS/navbar.css">
    </head>
    <body>
        
        <ul class="nav-bar">
<!--            <li><a href="/WashLaundry/HTML/homepage.php">Home</a></li>-->
            <li><a href="/WashLaundry/HTML/aboutUs.php">About Us</a></li>
            <li><a href="/WashLaundry/HTML/userprofile.php">Profile</a></li>
            <li><a href="/WashLaundry/HTML/service.php">Service</a></li>
            <li><a href="/WashLaundry/HTML/cart.php">Cart</a></li>
            <li><a href="/WashLaundry/HTML/login.php">Logout</a></li>
        </ul> 
        
        <div class="title">
            <h2>Profile Information</h2>
        </div>
        <div class="profile-info">
            <table>
                <tr>
                    <td>Username:</td>
                    <td><?php echo htmlspecialchars($userData["username"]); ?></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><?php echo htmlspecialchars($userData["email"]); ?></td>
                </tr>
                <tr>
                    <td>Phone:</td>
                    <td><?php echo htmlspecialchars($userData["phone"]); ?></td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td><?php echo htmlspecialchars($userData["address"]); ?></td>
                </tr>
<!--                <tr>
                    <td></td>
                    <td>
                        <button>Edit</button>
                        <button>Delete</button>
                    </td>
                </tr>-->
            </table>
        </div>
    </body>
</html>

