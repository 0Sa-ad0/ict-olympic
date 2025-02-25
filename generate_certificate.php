<?php
session_start();
require_once('fpdf.php'); // Library for PDF generation
include 'backend/db.php';

$user_id = $_GET['user_id'];
$user = $conn->query("SELECT name FROM users WHERE id = $user_id")->fetch_assoc();
$name = $user['name'];

// Create PDF Certificate
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(190, 10, 'ICT Olympic Certificate', 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', '', 14);
$pdf->Cell(190, 10, "This is to certify that", 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(190, 10, strtoupper($name), 0, 1, 'C');
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(190, 10, "has successfully completed the exam.", 0, 1, 'C');

$pdf->Ln(20);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(190, 10, 'Date: ' . date('Y-m-d'), 0, 1, 'C');

$certificatePath = "certificates/$user_id.pdf";
$pdf->Output($certificatePath, 'F');

$conn->query("UPDATE exam_results SET certificate_url='$certificatePath' WHERE user_id = $user_id");

header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=Certificate.pdf");
readfile($certificatePath);
exit();
?>