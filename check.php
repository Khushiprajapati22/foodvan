<?php

session_start();

// Include database connection
require_once 'db.php';

// Fetch products from the database
$sql = "SELECT * FROM cart where email='ajinkya@gmail.com'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "".$row['title']."--";
        echo "".$row['quantity']."--";

        $title=$row['title'];
        $qty=$row['quantity'];
        echo $title."---";
        echo $qty."----";

        $productStmt = $conn->prepare("SELECT image_path, description, price FROM products WHERE title = ?");
    $productStmt->bind_param("s", $title);
    $productStmt->execute();
    $result = $productStmt->get_result();

    while ($row = $result->fetch_assoc()) {
        echo "<br><br>".$row['image_path']."--";
    }
    }


} else {
    echo "<p>No categories available.</p>";
}

?>