<?php
require_once('tcpdf/tcpdf.php');

// Retrieve the ID of the record to be printed from the POST parameters
$applicationId = $_POST['id'];

// Generate the PDF using TCPDF
$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('times', '', 12);
$pdf->Write(5, "Application ID: $applicationId");
$pdf->Output('application.pdf', 'D');