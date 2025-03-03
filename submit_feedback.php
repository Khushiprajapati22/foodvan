
<?php
session_start();
// Database connection
$host = "localhost";
$username = "root";
$password = "abhi879687#";
$database = "spicymonk";

include 'notification.php';
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

    if(strlen($phone) != 10) {
        showNotification("Failed!", "Phone number must be 10 digits");
        $_SESSION['feedback'] = false;
        header("Location: contact.php");
        exit();
    }
    // Insert into database
    $sql = "INSERT INTO feedbacks (name, email, phone, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $name, $email, $phone, $message);

    if ($stmt->execute()) {
        showNotification("Success!", "Feedback submitted");
        $_SESSION['feedback'] = true;
       header("Location: contact.php");
    } else {
        showNotification("Failed!", "Failed submission");
        $_SESSION['feedback'] = false;
        header("Location: contact.php");
    }

    $stmt->close();
}

$conn->close();
?>
