<?php
// Include database connection
require_once 'db.php';

$status = $_GET['status'];
$sql = "UPDATE cart_status SET status='$status' LIMIT 1";
$conn->query($sql);

$conn->close();
echo "Status Updated";
?>
