<?php
session_start();
// Include database connection
require_once 'db.php';


if (!isset($_POST['id'])) {
    echo json_encode(['success' => false]);
    exit();
}

$id = intval($_POST['id']);
$useremail = $_SESSION['useremail'];

$sql = "DELETE FROM cart WHERE id = ? AND email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $id, $useremail);
$stmt->execute();

echo json_encode(['success' => true]);
?>
