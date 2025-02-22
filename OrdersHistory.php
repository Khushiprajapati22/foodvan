<?php
session_start();
require('fpdf.php');

// Redirect if not logged in
if (!isset($_SESSION['useremail'])) {
    header("Location: login.php");
    exit();
}

$useremail = $_SESSION['useremail'];
$mysqli = new mysqli("localhost", "root", "abhi879687#", "spicymonk");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Search functionality
$search_order_id = isset($_GET['search']) ? $_GET['search'] : '';
$query = "SELECT order_id, SUM(amount) AS total_amount, MIN(order_date) AS order_date 
          FROM orders WHERE email = ? ";
if ($search_order_id) {
    $query .= " AND order_id = ?";
}
$query .= " GROUP BY order_id ORDER BY order_date DESC";

$stmt = $mysqli->prepare($query);
if ($search_order_id) {
    $stmt->bind_param("ss", $useremail, $search_order_id);
} else {
    $stmt->bind_param("s", $useremail);
}
$stmt->execute();
$result = $stmt->get_result();

// Receipt Generation
if (isset($_GET['generate_receipt'])) {
    $order_id = $_GET['generate_receipt'];

    $sql = "SELECT o.quantity, o.title, p.price FROM orders o 
            JOIN products p ON o.title = p.title 
            WHERE o.order_id = ? AND o.email = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $order_id, $useremail);
    $stmt->execute();
    $order_items = $stmt->get_result();

    class PDF extends FPDF {
        function Header() {
            $this->Image('spicymonk-logo.png', 160, 10, 30);
            $this->SetFont('Arial', 'B', 16);
            $this->SetTextColor(0, 128, 0);
            $this->Cell(0, 10, 'SpicyMonk', 0, 1, 'L');
            $this->SetFont('Arial', '', 10);
            $this->Cell(0, 5, 'Pimple Nilakh, Pune, Maharashtra', 0, 1, 'L');
            $this->Ln(10);
        }
        function Footer() {
            $this->SetY(-50);
            $this->SetFont('Arial', 'B', 12);
            $this->SetTextColor(0, 128, 0);
            $this->Cell(0, 10, 'TERMS & CONDITIONS', 0, 1, 'L');
            $this->SetFont('Arial', '', 10);
            $this->MultiCell(0, 5, "Thank you for choosing SpicyMonk! We use fresh ingredients to deliver the best flavors.\nFor any issues or feedback, please contact us at support@spicymonk.com.\nAll sales are final. No refunds after food has been prepared.", 0, 'L');
        }
    }

    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetTextColor(0, 128, 0);
    $pdf->Cell(40, 10, 'INVOICE #', 0, 0, 'L');
    $pdf->Cell(40, 10, $order_id, 0, 0, 'L');
    $pdf->Cell(40, 10, 'INVOICE DATE', 0, 0, 'L');
    $pdf->Cell(40, 10, date('Y-m-d H:i:s'), 0, 1, 'L');
    $pdf->Cell(40, 10, 'CUSTOMER EMAIL', 0, 0, 'L');
    $pdf->Cell(40, 10, $useremail, 0, 1, 'L');
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

    while ($row = $order_items->fetch_assoc()) {
        $total = $row['quantity'] * $row['price'];
        $pdf->Cell(20, 8, $row['quantity'], 1, 0, 'C');
        $pdf->Cell(90, 8, $row['title'], 1, 0, 'L');
        $pdf->Cell(40, 8, number_format($row['price'], 2), 1, 0, 'R');
        $pdf->Cell(40, 8, number_format($total, 2), 1, 1, 'R');
        $subtotal += $total;
    }

    $gst = $subtotal * 0.12;
    $total = $subtotal + $gst;

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(150, 8, 'Subtotal', 0, 0, 'R');
    $pdf->Cell(40, 8, number_format($subtotal, 2), 0, 1, 'R');
    $pdf->Cell(150, 8, 'GST 12.0%', 0, 0, 'R');
    $pdf->Cell(40, 8, number_format($gst, 2), 0, 1, 'R');
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetTextColor(0, 128, 0);
    $pdf->Cell(150, 10, 'INVOICE TOTAL', 0, 0, 'R');
    $pdf->Cell(40, 10, number_format($total, 2), 0, 1, 'R');

    $pdf->Output();
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Order History</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('assets/images/faq-bg.png');
            background-size: cover;
            background-position: center;
        }
        .order-card { 
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1); 
            transition: transform 0.2s; 
        }
        .order-card:hover { 
            transform: scale(1.02); 
        }
        .search-bar {
            display: flex;
            align-items: center;
        }
        .search-bar input {
            width: 250px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <nav class="navbar navbar-dark bg-dark mb-4">
            <a class="navbar-brand mx-3">SpicyMonk</a>
            <form class="form-inline search-bar" method="GET">
                <input class="form-control" type="search" name="search" placeholder="Search Order ID">
                <button class="btn btn-success" type="submit">Search</button>
            </form>
        </nav>
        <h2 class="text-success">Order History</h2>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="card order-card mb-3 p-3">
                <h5>Order ID: <?php echo $row['order_id']; ?></h5>
                <!-- <p>Total: Rs?php echo number_format($row['total_amount'], 2); ?></p> -->
                <p>Date: <?php echo $row['order_date']; ?></p>
                <a href="?generate_receipt=<?php echo $row['order_id']; ?>" class="btn btn-dark">Receipt</a>
            </div>
        <?php } ?>
    </div>
</body>
</html>
