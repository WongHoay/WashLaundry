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

    header('Location: cart.php');
    exit();
}

// Handle removing items from the cart
if (isset($_GET['action']) && $_GET['action'] === 'remove' && isset($_GET['service'])) {
    $service = $_GET['service'];
    if (isset($_SESSION['cart'][$service])) {
        unset($_SESSION['cart'][$service]);
    }

    header('Location: cart.php');
    exit();
}

// Debugging output for removing items
//if (isset($_GET['action']) && $_GET['action'] === 'remove' && isset($_GET['service'])) {
//    $service = $_GET['service'];
//    echo "Attempting to remove: " . $service; // Debug output
//    if (isset($_SESSION['cart'][$service])) {
//        unset($_SESSION['cart'][$service]);
//        echo " - Successfully removed."; // Debug output
//    } else {
//        echo " - Service not found in cart."; // Debug output
//    }
//
//    header('Location: cart.php');
//    exit();
//}


// Calculate total items and cost
$totalItems = 0;
$totalCost = 0.00;

foreach ($_SESSION['cart'] as $service => $details) {
    $quantity = $details['quantity'];
    $price = $details['price'];
    $total = $quantity * $price;
    $totalItems += $quantity;
    $totalCost += $total;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Cart</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/cart.css"/>
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

        <div class="cart-container">
            <h2>Your Cart</h2>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody id="cart-items">
                    <!-- Cart items will be dynamically inserted here -->
                    <?php
                    foreach ($_SESSION['cart'] as $service => $details) {
                        $quantity = $details['quantity'];
                        $price = $details['price'];
                        $total = $quantity * $price;
                        echo "<tr>
                                <td>{$service}</td>
                                <td>RM{$price}</td>
                                <td>{$quantity}</td>
                                <td>RM{$total}</td>
                                <td><a href='cart.php?action=remove&service={$service}' class='remove-from-cart'>Remove</a></td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
            <div class="cart-summary">
                <h3>Summary</h3>
                <p>Total Items: <span id="total-items"><?= $totalItems ?></span></p>
                <p>Total Cost: <span id="total-cost">RM<?= number_format($totalCost, 2) ?></span></p>
                <button class="checkout" onclick="location.href='payment.php'">Proceed to Checkout</button>

            </div>
        </div>   
    </body>
</html>
