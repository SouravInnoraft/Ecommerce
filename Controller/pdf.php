<?php

use Fpdf\Fpdf;

session_start();
$pdf = new Fpdf();
$pdf->AddPage();
$pdf->Rect(5, 5, 200, 287);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 10, 'Product name:', 1, 0, 'L', false, '');
$pdf->Cell(50, 10, 'Price (Rs)', 1, 0, 'L', false, '');
$pdf->Cell(50, 10, 'quantity', 1, 1, 'L', false, '');
foreach ($rows as $row) {
  $pdf->Cell(50, 10, $row['product_name'], 1, 0, 'L', false, '');
  $pdf->Cell(50, 10, $row['product_price'], 1, 0, 'L', false, '');
  $pdf->Cell(50, 10, $row['quantity'], 1, 1, 'L', false, '');
  $total += $row['product_price'];
  $count += $row['quantity'];
}
$pdf->Cell(50, 10, 'Total:', 1, 0, 'L', false, '');
$pdf->Cell(50, 10, $total, 1, 0, 'L', false, '');
$pdf->Cell(50, 10, $count, 1, 0, 'L', false, '');
try {
  $pdf->Output('F', '../pdf/Invoice.pdf');
}
catch (Exception $e) {
  echo $e;
}
