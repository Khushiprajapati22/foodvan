<?php
session_start();
require('fpdf.php');
include 'notification.php';

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: admin.php");
    exit();
}

// Include database connection
require_once 'db.php';

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(190, 10, 'FoodVan Report', 0, 1, 'C');
        $this->Ln(10);
    }
    function Footer()
    {
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

    $tables = [
        'sales' => ['orders', ['order_id', 'username', 'title', 'amount']],
        'suppliers' => ['suppliers', ['id', 'name', 'email', 'contact']],
        'products' => ['products', ['id', 'title', 'rating', 'price', 'type', 'category']],
        'customers' => ['user_details', ['firstname', 'lastname', 'email', 'contact', 'Uaddress']]
    ];
    if (array_key_exists($reportType, $tables)) {
        list($table, $columns) = $tables[$reportType];

        $pdf->Cell(190, 8, ucfirst($reportType) . ' Report', 0, 1, 'C');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', 'B', 8); // Reduced font size

        // Calculate column width dynamically
        $colCount = count($columns);
        $colWidth = ($colCount > 4) ? 190 / $colCount : 40;
        $tableWidth = $colWidth * $colCount;
        $xPosition = (210 - $tableWidth) / 2; // Centering calculation

        // Move to center
        $pdf->SetX($xPosition);

        // Print headers
        foreach ($columns as $col) {
            $pdf->Cell($colWidth, 6, ucfirst($col), 1);
        }
        $pdf->Ln();

        $pdf->SetFont('Arial', '', 7); // Smaller font for better fit

        $result = $conn->query("SELECT " . implode(", ", $columns) . " FROM $table");

        while ($row = $result->fetch_assoc()) {
            $pdf->SetX($xPosition); // Center each row

            foreach ($columns as $col) {
                if ($col == 'Uaddress') {
                    $pdf->MultiCell($colWidth, 6, $row[$col], 1);
                } else {
                    $pdf->Cell($colWidth, 6, $row[$col], 1);
                }
            }
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
            <br>
            <div class="report-container">
                <?php
                $reportTypes = ['sales' => 'Sales Report', 'suppliers' => 'Suppliers Report', 'products' => 'Products Report', 'customers' => 'Customer Report'];
                foreach ($reportTypes as $type => $label) {
                    echo "<div class='report-card'>
                        <h3>$label</h3>
                        <form method='POST'>
                            <input type='hidden' name='report_type' value='$type'>
                            <button type='submit' name='download_report'>Download</button>
                        </form>
                      </div>";
                }
                ?>
            </div>
        </main>
    </section>

    <script src="dashscript.js"></script>

</body>

</html>

<?php
$conn->close();
?>