
<?php
session_start();
// Include database connection
require_once 'db.php';
require_once 'notification.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['Message']; // Case-sensitive

    if(preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email) == 0){
        $_SESSION['feedback'] = false;
        $_SESSION['feedback_message'] = "Invalid email format";
        header("Location: contact.php");
        exit();

}else{
    if(strlen($phone) != 10) {
        $_SESSION['feedback'] = false;
        $_SESSION['feedback_message'] = "Phone number must be 10 digits";
        header("Location: contact.php");
        exit();
    }
    // Insert into database
    $sql = "INSERT INTO feedbacks (name, email, phone, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $name, $email, $phone, $message);

    if ($stmt->execute()) {
        $_SESSION['feedback'] = true;
        $_SESSION['feedback_message'] = "Feedback submitted successfully!";
       header("Location: contact.php");
       exit();
    } else {
        $_SESSION['feedback'] = false;
        $_SESSION['feedback_message'] = "Failed to submit feedback. Please try again.";
        header("Location: contact.php");
        exit();
    }
}

    $stmt->close();
}

$conn->close();
?>
