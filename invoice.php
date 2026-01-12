<?php
require('fpdf/fpdf.php');
include("query.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$tracking_number = $_GET['tracking_number'] ?? '';

if (empty($tracking_number)) {
    die("Invalid Invoice Request");
}

$order_q = mysqli_query($con, "SELECT * FROM orders WHERE tracking_number = '$tracking_number'");
$orders = mysqli_fetch_all($order_q, MYSQLI_ASSOC);

if (empty($orders)) {
    die("Order not found");
}

$first = $orders[0];

/* =====================
   CREATE PDF
===================== */

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 15);

/* ===== LOGO & HEADER ===== */
$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(0, 10, 'ZUFE', 0, 1, 'L');

$pdf->SetFont('Arial', '', 11);
$pdf->Cell(0, 6, 'Fashion & Apparel Store', 0, 1);
$pdf->Cell(0, 6, 'Email: support@zufe.com', 0, 1);
$pdf->Cell(0, 6, 'Phone: +92 300 0000000', 0, 1);

$pdf->Ln(8);

/* ===== INVOICE INFO ===== */
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 8, 'Invoice To:', 0, 0);
$pdf->Cell(0, 8, 'Invoice Details:', 0, 1);

$pdf->SetFont('Arial', '', 11);
$pdf->Cell(100, 6, $first['name'], 0, 0);
$pdf->Cell(0, 6, 'Invoice #: ' . $first['tracking_number'], 0, 1);

$pdf->Cell(100, 6, $first['address'], 0, 0);
$pdf->Cell(0, 6, 'Date: ' . date('d M Y'), 0, 1);

$pdf->Cell(100, 6, $first['city'] . ', ' . $first['country'], 0, 1);
$pdf->Ln(6);

/* ===== TABLE HEADER ===== */
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(70, 8, 'Product', 1);
$pdf->Cell(20, 8, 'Price', 1, 0, 'R');
$pdf->Cell(20, 8, 'Qty', 1, 0, 'C');
$pdf->Cell(30, 8, 'Tax', 1, 0, 'R');
$pdf->Cell(30, 8, 'Total', 1, 1, 'R');

/* ===== TABLE BODY ===== */
$pdf->SetFont('Arial', '', 11);

$subtotal = 0;
$total_tax = 0;

foreach ($orders as $item) {
    $line_total = $item['proprice'] * $item['proqty'];
    $subtotal += $line_total;
    $total_tax += (float) $item['item_tax'];

    $pdf->Cell(70, 8, $item['proname'], 1);
    $pdf->Cell(20, 8, 'Rs. ' . number_format($item['proprice']), 1, 0, 'R');
    $pdf->Cell(20, 8, $item['proqty'], 1, 0, 'C');
    $pdf->Cell(30, 8, 'Rs. ' . number_format($item['item_tax'], 2), 1, 0, 'R');
    $pdf->Cell(30, 8, 'Rs. ' . number_format($line_total), 1, 1, 'R');
}

/* ===== TOTALS ===== */
$shipping = (float) $first['shipping_charges'];
$grand_total = $subtotal + $shipping + $total_tax;

$pdf->Ln(4);
$pdf->Cell(140, 8, 'Subtotal', 0, 0, 'R');
$pdf->Cell(30, 8, 'Rs. ' . number_format($subtotal), 0, 1, 'R');

$pdf->Cell(140, 8, 'Shipping', 0, 0, 'R');
$pdf->Cell(30, 8, 'Rs. ' . number_format($shipping), 0, 1, 'R');

if ($total_tax > 0) {
    $pdf->Cell(140, 8, 'Tax', 0, 0, 'R');
    $pdf->Cell(30, 8, 'Rs. ' . number_format($total_tax, 2), 0, 1, 'R');
}

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(140, 10, 'Grand Total', 0, 0, 'R');
$pdf->Cell(30, 10, 'Rs. ' . number_format($grand_total), 0, 1, 'R');

/* ===== FOOTER ===== */
$pdf->Ln(10);
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 8, 'Thank you for shopping with ZUFE!', 0, 1, 'C');
$pdf->Cell(0, 6, 'This is a computer-generated invoice.', 0, 1, 'C');

/* ===== OUTPUT ===== */
$pdf->Output('I', 'Zufe-Invoice-' . $tracking_number . '.pdf');
