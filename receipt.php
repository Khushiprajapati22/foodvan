<?php
require('fpdf.php');
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

// Fetch latest order details
$sql = "SELECT order_id, email FROM orders ORDER BY id DESC LIMIT 1";  
$result = $conn->query($sql);
if ($result->num_rows === 0) {
    die("No order found!");
}

$row = $result->fetch_assoc();
$order_id = $row['order_id'];
$email = $row['email'];

// Fetch order items with price from products table
$sql = "SELECT o.quantity, o.title, p.price 
        FROM orders o
        JOIN products p ON o.title = p.title
        WHERE o.order_id = ? AND o.email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $order_id, $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("No order items found!");
}

$orderDetails = [];
while ($row = $result->fetch_assoc()) {
    $orderDetails[] = $row;
}

$stmt->close();
$conn->close();

// Generate PDF Invoice
class PDF extends FPDF
{
    function Header()
    {
        $this->Image('spicymonk-logo.png', 160, 10, 30);
        $this->SetFont('Arial', 'B', 16);
        $this->SetTextColor(0, 128, 0);
        $this->Cell(0, 10, 'SpicyMonk', 0, 1, 'L');
        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(0, 5, 'Pimple Nilakh, Pune, Maharashtra', 0, 1, 'L');
        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-50);
        $this->SetFont('Arial', 'B', 12);
        $this->SetTextColor(0, 128, 0);
        $this->Cell(0, 10, 'TERMS & CONDITIONS', 0, 1, 'L');
        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(0, 0, 0);
        $this->MultiCell(0, 5, "Thank you for choosing SpicyMonk! We use fresh ingredients to deliver the best flavors.\nFor any issues or feedback, please contact us at support@spicymonk.com.\nAll sales are final. No refunds after food has been prepared.", 0, 'L');
    }
}

$pdf = new PDF();
$pdf->AddPage();

// Invoice Header
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0, 128, 0);
$pdf->Cell(40, 10, 'INVOICE #', 0, 0, 'L');
$pdf->Cell(40, 10, $order_id, 0, 0, 'L');
$pdf->Cell(40, 10, 'INVOICE DATE', 0, 0, 'L');
$pdf->Cell(40, 10, date('Y-m-d H:i:s'), 0, 1, 'L');

$pdf->Cell(40, 10, 'CUSTOMER EMAIL', 0, 0, 'L');
$pdf->Cell(40, 10, $email, 0, 1, 'L');

// Table Headers
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(0, 128, 0);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(20, 8, 'QTY', 1, 0, 'C', true);
$pdf->Cell(90, 8, 'ITEM', 1, 0, 'C', true);
$pdf->Cell(40, 8, 'UNIT PRICE', 1, 0, 'C', true);
$pdf->Cell(40, 8, 'TOTAL', 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(0, 0, 0);

$subtotal = 0;
foreach ($orderDetails as $order) {
    $price = $order['price'] ?? 0; // Avoid null errors
    $amount = $order['quantity'] * $price;
    
    $pdf->Cell(20, 8, $order['quantity'], 1, 0, 'C');
    $pdf->Cell(90, 8, $order['title'], 1, 0, 'L');
    $pdf->Cell(40, 8, number_format($price, 2), 1, 0, 'R');
    $pdf->Cell(40, 8, number_format($amount, 2), 1, 1, 'R');
    $subtotal += $amount;
}

// Subtotal, GST, and Total
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(150, 8, 'Subtotal', 0, 0, 'R');
$pdf->Cell(40, 8, number_format($subtotal, 2), 0, 1, 'R');

$gst = $subtotal * 0.12;
$pdf->Cell(150, 8, 'GST 12.0%', 0, 0, 'R');
$pdf->Cell(40, 8, number_format($gst, 2), 0, 1, 'R');

$total = $subtotal + $gst;
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(0, 128, 0);
$pdf->Cell(150, 10, 'INVOICE TOTAL', 0, 0, 'R');
$pdf->Cell(40, 10, number_format($total, 2), 0, 1, 'R');

$pdf->Output();
?>
