<?php
require_once('fpdf181/fpdf.php');
$username = 'marc'; 

$pdf = new FPDF();
$pdf->AddPage();
$pdf->Image('images/logo.png',11.5,10,30);
$pdf->SetFont('Arial','B',24);
$pdf->Cell(170,10,'',0,1);
$pdf->Cell(170,15,"$username's soon Einträge für Januar 2018",0,1);
$pdf->SetFont('Arial','',11);
$pdf->Cell(170,10,'Deine soon Einträge für ',0,1);
$pdf->Output();
?>