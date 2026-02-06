<?php
require('fpdf/fpdf.php');

$nom = $_POST['nom'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';
$services = $_POST['services'] ?? [];

$total = 0;
$serviceList = [];

foreach ($services as $service) {
    list($label, $price) = explode('|', $service);
    $serviceList[] = [$label, $price];
    $total += (int)$price;
}

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

// TITRE
$pdf->Cell(0,10,'DEVIS - CDS SERVICES',0,1,'C');
$pdf->Ln(5);

// INFOS CLIENT
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,8,"Nom : $nom",0,1);
$pdf->Cell(0,8,"Email : $email",0,1);
$pdf->Ln(5);

// SERVICES
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,8,"Services demandes :",0,1);
$pdf->Ln(2);

$pdf->SetFont('Arial','',11);
foreach ($serviceList as $s) {
    $pdf->Cell(120,8,$s[0],1);
    $pdf->Cell(0,8,number_format($s[1]).' FCFA',1,1);
}

// TOTAL
$pdf->SetFont('Arial','B',12);
$pdf->Cell(120,10,'TOTAL',1);
$pdf->Cell(0,10,number_format($total).' FCFA',1,1);

$pdf->Ln(10);

// MESSAGE
$pdf->MultiCell(0,8,"Message client :\n$message");

// SORTIE
$pdf->Output('I', 'devis_cds_services.pdf');
