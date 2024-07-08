<?php
session_start();

// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle adding items to the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $service = $_POST['service'];
    $price = $_POST['price'];
    $quantity = 1; // Default quantity for simplicity

    if (isset($_SESSION['cart'][$service])) {
        $_SESSION['cart'][$service]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$service] = ['price' => $price, 'quantity' => $quantity];
    }

    // Redirect back to the service page after adding to cart
    header('Location: service.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Service</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/service.css">
    <link rel="stylesheet" href="../CSS/navbar.css">
</head>
<body>
    <ul class="nav-bar">
    <!--        <li><a href="/WashLaundry/HTML/homepage.php">Home</a></li>-->
        <li><a href="/WashLaundry/HTML/aboutUs.php">About Us</a></li>
        <li><a href="/WashLaundry/HTML/userprofile.php">Profile</a></li>
        <li><a href="/WashLaundry/HTML/service.php">Service</a></li>
        <li><a href="/WashLaundry/HTML/cart.php">Cart</a></li>
        <li><a href="/WashLaundry/HTML/login.php">Logout</a></li>
    </ul> 
    
    <div class="service-container">
        <h2>Our Service</h2>
        <div class="service-item">
            <h3>Wash and Fold</h3>
            <p>RM 10 per kg</p>
            <form action="service.php" method="post">
                <input type="hidden" name="service" value="Wash and Fold">
                <input type="hidden" name="price" value="10">
                <input type="hidden" name="action" value="add">
                <button type="submit" class="add-to-cart">Add to Cart</button>
            </form>
        </div>

        <div class="service-item">
            <h3>Dry Cleaning</h3>
            <p>RM 10 per kg</p>
            <form action="service.php" method="post">
                <input type="hidden" name="service" value="Dry Cleaning">
                <input type="hidden" name="price" value="10">
                <input type="hidden" name="action" value="add">
                <button type="submit" class="add-to-cart">Add to Cart</button>
            </form>
        </div>

        <div class="service-item">
            <h3>Ironing</h3>
            <p>RM 10 per kg</p>
            <form action="service.php" method="post">
                <input type="hidden" name="service" value="Ironing">
                <input type="hidden" name="price" value="10">
                <input type="hidden" name="action" value="add">
                <button type="submit" class="add-to-cart">Add to Cart</button>
            </form>
        </div>

        <div class="service-item">
            <h3>Delivery</h3>
            <p>RM 12</p>
            <form action="service.php" method="post">
                <input type="hidden" name="service" value="Delivery">
                <input type="hidden" name="price" value="12">
                <input type="hidden" name="action" value="add">
                <button type="submit" class="add-to-cart">Add to Cart</button>
            </form>
        </div>
    </div>

    <script src="../HTML/cart.js"></script>
</body>
</html>
