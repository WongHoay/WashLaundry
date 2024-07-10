<?php
include "dbFunction.php";
// Start the session
session_start();

 //Placeholder for fetching user data from a database
 //Assume you have a function `getUserData` that fetches user data based on session or some identifier
function getUserData($username,$conn) {
//    // Dummy data for demonstration
//    return [
////        "username" => "Amli Lee",
////        "email" => "ammlee@gmail.com",
////        "phone" => "014 456-4540",
////        "address" => "No2, Jalan Seri Pina 5, 11600 Penang"
////        "username" => "",
////        "email" => "",
////        "contact" => "",
////        "address" => ""
//            
//    ];
//    $pdo = dbConnect();
//    $stmt = $pdo->prepare('SELECT username, email, phone, address FROM users WHERE username = ?');
//    $stmt->execute([$username]);
//    return $stmt->fetch();
    $sql = "SELECT username, email, contact, address FROM user WHERE username = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    } else {
        return null;
    }
}

// Check if the user is logged in
//if (!isset($_SESSION['username'])) {
//    header("Location: login.php");
//    exit();
//}

// Fetch user data
//$userData = getUserData($_SESSION['username']);

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch user data
$conn = dbConnect();
$userData = getUserData($_SESSION['username'], $conn);
$conn->close();

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
                    <td><?php echo htmlspecialchars($userData["contact"]); ?></td>
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

