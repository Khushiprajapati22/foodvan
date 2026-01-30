<?php
session_start();
// Include database connection
require_once 'db.php';

if (!isset($_POST['id']) || !isset($_POST['action'])) {
    echo json_encode(['success' => false]);
    exit();
}

$id = intval($_POST['id']);
$action = $_POST['action'];
$useremail = $_SESSION['useremail'];


if ($action === 'increment') {
    $sql = "UPDATE cart SET quantity = quantity + 1 WHERE id = ? AND email = ?";
} elseif ($action === 'decrement') {
    $sql = "UPDATE cart SET quantity = quantity - 1 WHERE id = ? AND email = ? AND quantity > 1";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $id, $useremail);
$stmt->execute();

// Fetch updated quantity and total price for the specific item
$sql = "SELECT quantity, (quantity * products.price) as totalPrice FROM cart JOIN products ON cart.title = products.title WHERE cart.id = ? AND cart.email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $id, $useremail);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

$updated_quantity = $result['quantity'];
$item_total_price = $result['totalPrice'];

// Fetch updated cart subtotal
$sql = "SELECT SUM(cart.quantity * products.price) as subtotal FROM cart JOIN products ON cart.title = products.title WHERE cart.email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $useremail);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

$subtotal = $result['subtotal'];
$tax = $subtotal * 0.12;
$total = $subtotal + $tax;

// Return response
echo json_encode([
    'success' => true,
    'quantity' => $updated_quantity,
    'totalPrice' => number_format($item_total_price, 2),
    'subtotal' => number_format($subtotal, 2),
    'tax' => number_format($tax, 2),
    'total' => number_format($total, 2)
]);
?>
