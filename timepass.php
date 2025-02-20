<?php

require('fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        // Logo
        $this->Image('spicymonk-logo.png', 160, 10, 30); // Replace 'logo.png' with your logo file
        $this->SetFont('Arial', 'B', 16);
        $this->SetTextColor(0, 128, 0);
        $this->Cell(0, 10, 'Saffron Design', 0, 1, 'L');
        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(0, 5, '77 Namrata Bldg, Delhi, Delhi 400077', 0, 1, 'L');
        $this->Ln(10);
    }

    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-50);
        $this->SetFont('Arial', 'B', 12);
        $this->SetTextColor(0, 128, 0);
        $this->Cell(0, 10, 'TERMS & CONDITIONS', 0, 1, 'L');
        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(0, 0, 0);
        $this->MultiCell(0, 5, "Payment is due within 15 days.\nState Bank of India\nAccount Number: 12345678\nRouting Number: 09876543210", 0, 'L');
    }
}

// Create instance
$pdf = new PDF();
$pdf->AddPage();

// Invoice Header Section
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0, 128, 0);
$pdf->Cell(40, 10, 'INVOICE #', 0, 0, 'L');
$pdf->Cell(40, 10, 'IN-001', 0, 0, 'L');
$pdf->Cell(40, 10, 'INVOICE DATE', 0, 0, 'L');
$pdf->Cell(40, 10, '29/01/2019', 0, 1, 'L');

$pdf->Cell(40, 10, 'P.O.#', 0, 0, 'L');
$pdf->Cell(40, 10, '2430/2019', 0, 0, 'L');
$pdf->Cell(40, 10, 'DUE DATE', 0, 0, 'L');
$pdf->Cell(40, 10, '26/04/2019', 0, 1, 'L');

// Billing & Shipping Section
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(90, 10, 'BILL TO', 0, 0, 'L');
$pdf->Cell(90, 10, 'SHIP TO', 0, 1, 'L');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(90, 5, "Kavindra Mannan\n27, Dlf City, Gupta\nDelhi, Delhi 40003", 0, 0, 'L');
$pdf->Cell(90, 5, "Kavindra Mannan\n264, Abdul Rehman\nMumbai, Bihar 40009", 0, 1, 'L');

// Table Headers
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(0, 128, 0);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(20, 8, 'QTY', 1, 0, 'C', true);
$pdf->Cell(90, 8, 'DESCRIPTION', 1, 0, 'C', true);
$pdf->Cell(40, 8, 'UNIT PRICE', 1, 0, 'C', true);
$pdf->Cell(40, 8, 'AMOUNT', 1, 1, 'C', true);

// Table Rows
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(20, 8, '1', 1, 0, 'C');
$pdf->Cell(90, 8, 'Frontend design restructure', 1, 0, 'L');
$pdf->Cell(40, 8, '9,999.00', 1, 0, 'R');
$pdf->Cell(40, 8, '9,999.00', 1, 1, 'R');

$pdf->Cell(20, 8, '2', 1, 0, 'C');
$pdf->Cell(90, 8, 'Custom icon package', 1, 0, 'L');
$pdf->Cell(40, 8, '975.00', 1, 0, 'R');
$pdf->Cell(40, 8, '1,950.00', 1, 1, 'R');

$pdf->Cell(20, 8, '3', 1, 0, 'C');
$pdf->Cell(90, 8, 'Gandhi mouse pad', 1, 0, 'L');
$pdf->Cell(40, 8, '99.00', 1, 0, 'R');
$pdf->Cell(40, 8, '297.00', 1, 1, 'R');

// Subtotal, GST, and Total
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(150, 8, 'Subtotal', 0, 0, 'R');
$pdf->Cell(40, 8, '12,246.00', 0, 1, 'R');

$pdf->Cell(150, 8, 'GST 12.0%', 0, 0, 'R');
$pdf->Cell(40, 8, '1,469.52', 0, 1, 'R');

$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(0, 128, 0);
$pdf->Cell(150, 10, 'INVOICE TOTAL', 0, 0, 'R');
$pdf->Cell(40, 10, '13,715.52', 0, 1, 'R');

// Signature
$pdf->Ln(15);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 10, '___________________________', 0, 1, 'R');
$pdf->Cell(0, 5, 'Priya Chopra', 0, 1, 'R');

$pdf->Output();


?>