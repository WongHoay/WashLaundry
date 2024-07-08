<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/html.html to edit this template
-->
<html>
    <head>
        <title>Payment Confirmation</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!-- Popper -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <style>
            body {
                background-color: #f8f9fa;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .confirmation-container {
                background: white;
                padding: 2rem;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                text-align: center;
            }
            .confirmation-container h2 {
                color: #0A2342;
            }
            .confirmation-container .receipt {
                margin-top: 2rem;
                text-align: left;
                border-top: 1px solid #dee2e6;
                padding-top: 1rem;
            }
            .home-btn {
                margin-top: 2rem;
                background-color: #0A2342;
                color: white;
                border: none;
                padding: 0.75rem 1.5rem;
                border-radius: 4px;
                cursor: pointer;
            }
            .home-btn:hover {
                background-color: #bbdcf0;
            }
        </style>
    </head>
    <body>
        <div class="confirmation-container">
            <h2>Payment Confirmation</h2>
            <p>Thank you for your payment!</p>
            <p>Your transaction was successful.</p>
            <div class="receipt">
                <h3>Receipt</h3>
                <div id="receipt-details">
                    <?php
                    // Assuming receipt details are stored in a variable called $receiptDetails
                    // This can be retrieved from a database or passed via POST/GET methods
                    $receiptDetails = [
                        "Transaction ID" => "123456789",
                        "Amount" => "$100.00",
                        "Date" => date("Y-m-d H:i:s"),
                        "Payment Method" => "Credit Card"
                    ];
                    foreach ($receiptDetails as $key => $value) {
                        echo "<p><strong>$key:</strong> $value</p>";
                    }
                    ?>
                </div>
            </div>
            <button class="home-btn" onclick="redirectToHome()">Return to Home</button>
        </div>

        <script>
            function redirectToHome() {
                window.location.href = 'service.php'; // Replace with your home page URL
            }
        </script>
    </body>
</html>

