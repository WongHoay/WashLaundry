<?php
session_start();

// Check if the cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit();
}

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

// Handle payment submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['paymentproof'])) {
        $file = $_FILES['paymentproof'];

        // Validate file
        $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB
        $uploadDir = 'uploads/';

        if (in_array($file['type'], $allowedTypes) && $file['size'] <= $maxFileSize) {
            $filePath = $uploadDir . basename($file['name']);

            // Move the uploaded file to the secure directory
            if (move_uploaded_file($file['tmp_name'], $filePath)) {
                // Verify the payment proof (this would be specific to your application)
                $paymentVerified = verifyPaymentProof($filePath);

                if ($paymentVerified) {
                    $paymentSuccess = true;
                } else {
                    $paymentError = 'Payment verification failed. Please try again.';
                }
            } else {
                $paymentError = 'Failed to upload file. Please try again.';
            }
        } else {
            $paymentError = 'Invalid file type or file size exceeds limit.';
        }
    }

    if (isset($paymentSuccess) && $paymentSuccess) {
        // Clear the cart
        unset($_SESSION['cart']);
        // Redirect to a confirmation page
        header('Location: confirmation.php');
        exit();
    } else {
        // Redirect back to payment page with an error message
        header('Location: payment.php?error=' . urlencode($paymentError));
        exit();
    }
}

function verifyPaymentProof($filePath) {
    // Placeholder function for payment verification logic
    // This could involve checking the file content, contacting the payment processor, etc.
    // For this example, let's assume the verification is successful
    return true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Options</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/payment.css">
    <link rel="stylesheet" href="../CSS/navbar.css">
</head>
<body>
    <ul class="nav-bar">
        <li><a href="/WashLaundry/HTML/aboutUs.php">About Us</a></li>
        <li><a href="/WashLaundry/HTML/userprofile.php">Profile</a></li>
        <li><a href="/WashLaundry/HTML/service.php">Service</a></li>
        <li><a href="/WashLaundry/HTML/cart.php">Cart</a></li>
        <li><a href="/WashLaundry/HTML/login.php">Logout</a></li>
    </ul> 
    
    <div class="payment-container">
        <h2>Payment Options</h2>
        <div class="payment-methods">
            <button type="button" class="payment-option" id="qr-payment-btn" onclick="showQrPaymentForm()">Pay with QR</button>
        </div>

        <div class="payment-forms">
            <!-- QR Payment -->
            <div id="qr-payment" class="payment-form">
                <h3>QR Payment</h3>
                <p>Scan the QR code to make the payment.</p>
                <img src="paymentQR.jpg" alt="QR Code">
                <div class="receipt">
                    <h3>Receipt</h3>
                    <div id="receipt-details">
                        <!-- Receipt details will be dynamically inserted here -->
                        <form method="post" enctype="multipart/form-data">
                            <input type="file" id="paymentproof" name="paymentproof" required>
                            <button type="submit" class="checkout">Submit Payment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showQrPaymentForm() {
            document.getElementById('qr-payment').style.display = 'block';
        }
        showQrPaymentForm(); // Show QR payment form by default
    </script>
</body>
</html>



