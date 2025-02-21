<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "abhi879687#";
$database = "spicymonk";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['Message']; // Case-sensitive

    // Insert into database
    $sql = "INSERT INTO feedbacks (name, email, phone, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $name, $email, $phone, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Feedback submitted successfully!');</script>";
    } else {
        echo "<script>alert('Submission failed!');</script>";
    }
    
    $stmt->close();
}

$conn->close();
?>
