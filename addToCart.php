<?php
session_start();


    // Database
    $host = "localhost"; 
    $username = "root";
    $password = "abhi879687#";
    $database = "spicymonk"; 
    
    $conn = new mysqli($host, $username, $password, $database);
    
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    $productTitle = $input['title'];

    // Check if user is logged in
    if (!isset($_SESSION['useremail'])) {
        echo "User not logged in.";
        exit;
    }
    $userEmail = $_SESSION['useremail'];

    // Check if the product exists in the cart for the user
    $query = "SELECT * FROM cart WHERE email = ? AND title = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $userEmail, $productTitle);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If the product exists, update the quantity
        $updateQuery = "UPDATE cart SET quantity = quantity + 1 WHERE email = ? AND title = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("ss", $userEmail, $productTitle);
        if ($updateStmt->execute()) {
            echo "Product quantity updated in cart.";
        } else {
            echo "Failed to update product quantity.";
        }
    } else {
        // If the product doesn't exist, insert it into the cart
        $insertQuery = "INSERT INTO cart (email, title, quantity) VALUES (?, ?, 1)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("ss", $userEmail, $productTitle);
        if ($insertStmt->execute()) {
            
        } else {
            echo "Failed to add product to cart.";
        }
    }
}
?>
