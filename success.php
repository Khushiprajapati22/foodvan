<?php
session_start();
// Database connection
$host = "localhost";
$username = "root";
$password = "abhi879687#";
$database = "spicymonk";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['order_id'], $_GET['email'], $_GET['username'], $_GET['amount'], $_GET['contact'], $_GET['order_date'])) {
    $order_id = $_GET['order_id'];
    $useremail = $_GET['email'];
    $username = $_GET['username'];
    $amount = $_GET['amount'];
    $contact = $_GET['contact'];
    $order_date = $_GET['order_date']; 

    // Fetch cart items for the user
    $cartQuery = "SELECT title, quantity FROM cart WHERE email = ?";
    $cartStmt = $conn->prepare($cartQuery);
    $cartStmt->bind_param("s", $useremail);
    $cartStmt->execute();
    $cartResult = $cartStmt->get_result();

    if ($cartResult->num_rows > 0) {
        // Insert each cart item into the orders table
        $orderSql = "INSERT INTO orders (order_id, email, username, title, quantity, amount, contact, order_date) 
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $orderStmt = $conn->prepare($orderSql);
        
        while ($row = $cartResult->fetch_assoc()) {
            $title = $row['title'];
            $quantity = $row['quantity'];

            $orderStmt->bind_param("ssssisss", $order_id, $useremail, $username, $title, $quantity, $amount, $contact, $order_date);
            $orderStmt->execute();
        }

        // Clear cart after order is placed
        $clearCartSql = "DELETE FROM cart WHERE email = ?";
        $clearCartStmt = $conn->prepare($clearCartSql);
        $clearCartStmt->bind_param("s", $useremail);
        $clearCartStmt->execute();
        
       
    } else {
        echo "<center><h1>Cart is empty!</h1></center>";
        exit();
    }

    $cartStmt->close();
    $orderStmt->close();
    $clearCartStmt->close();
    $conn->close();
} else {
    echo "Invalid request!";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success | SpicyMonk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .success-container {
            max-width: 400px;
            margin: auto;
            padding: 40px;
            background: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }
        .success-icon {
            width: 60px;
            margin-bottom: 15px;
        }
        .btn-custom {
            width: 100%;
            margin-top: 10px;
        }
    </style>
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="success-container">
        <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="Success" class="success-icon">
        <h2 class="text-success">Order Placed Successfully!</h2>
        <p class="text-muted">Thank you for your order. Your food is on the way.</p>

        <a href="receipt.php" class="btn btn-primary btn-custom">Download Receipt</a>
        <a href="index.php" class="btn btn-secondary btn-custom">Back to Home</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

