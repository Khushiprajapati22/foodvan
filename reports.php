<?php
session_start();
require('fpdf.php');
include 'notification.php';

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: admin.php");
    exit();
}

$host = "localhost";  
$username = "root";  
$password = "abhi879687#";  
$database = "spicymonk";  

$conn = new mysqli($host, $username, $password, $database);  

if ($conn->connect_error) {  
    die("Connection failed: " . $conn->connect_error);  
}

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(190, 10, 'SpicyMonk Report', 0, 1, 'C');
        $this->Ln(10);
    }
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

if (isset($_POST['download_report'])) {
    $reportType = $_POST['report_type'];
    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);
    
    if ($reportType == 'sales') {
        $pdf->Cell(190, 10, 'Sales Report', 0, 1, 'C');
        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 10, 'Order ID', 1);
        $pdf->Cell(50, 10, 'Username', 1);
        $pdf->Cell(50, 10, 'Title', 1);
        $pdf->Cell(30, 10, 'Amount', 1);
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 10);
        $result = $conn->query("SELECT order_id, username, title, amount FROM orders");
        while ($row = $result->fetch_assoc()) {
            $pdf->Cell(40, 10, $row['order_id'], 1);
            $pdf->Cell(50, 10, $row['username'], 1);
            $pdf->Cell(50, 10, $row['title'], 1);
            $pdf->Cell(30, 10, $row['amount'], 1);
            $pdf->Ln();
        }
    }
    
    $pdf->Output();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="icon" href="assets/icons/SpicyMonk-Logo-V2.png" type="image/icon type">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="dashboard.css">
    <style>
        .report-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .report-card {
            background: white;
            padding: 15px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 250px;
            text-align: center;
        }
        .report-card h3 {
            margin-bottom: 10px;
        }
        .report-card button {
            background-color: lightblue;
            border: none;
            padding: 10px 15px;
            border-radius: 10px;
            cursor: pointer;
        }
        .report-card button:hover {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>

<?php include 'sidebar.php'; ?>

<section id="content">
    <nav>
        <i class='bx bx-menu'></i>
    </nav>

    <main>
        <div class="head-title">
            <div class="left">
                <h1>Reports</h1>
                <ul class="breadcrumb">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li><a class="active" href="reports.php">Reports</a></li>
                </ul>
            </div>
        </div>

        <div class="report-container">
            <div class="report-card">
                <h3>Sales Report</h3>
                <form method="POST">
                    <input type="hidden" name="report_type" value="sales">
                    <button type="submit" name="download_report">Download</button>
                </form>
            </div>
        </div>
    </main>
</section>

<script src="dashscript.js"></script>

</body>
</html>

<?php
$conn->close();
?>
