<?php
	include 'inlcude_all.php';
	include 'loginwall.php';		
	require_once('fpdf181/fpdf.php');
	
	if(empty($_GET['y'])) {
		$year = date('Y');
	} else {
		$year = $_GET['y'];
	}
	
	if(empty($_GET['mm'])) {
		$month = date('F');
	} else {
		$month = $_GET['mm'];
	}

	$timestamp = strtotime("$year $month");
	$date_today = date("d. F Y", time());

	$timestamp_of_month = strtotime(date("Y-m-1 00:00", $timestamp));
	$last_day_of_month = strtotime(date("Y-m-t 24:00", $timestamp_of_month));


	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->Image('images/logo.png',11.5,10,30);

	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(170,10,'',0,1);
	$pdf->Cell(36,15,"www.soon-calendar.ch",0,0);

	$pdf->SetFont('Arial','',9);
	$pdf->Cell(170,15,"Alle deine Termine – immer und überall abrufbar.",0,1);

	$pdf->Cell(170,15,"$username generierte diese Übersicht am $date_today.",0,1);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(170,15,"$month $year",0,1);

	
	while($timestamp < $last_day_of_month) {
		$first_timestamp_of_day = strtotime(date("Y-m-d 00:00:00", $timestamp));
		$last_timestamp_of_day = strtotime(date("Y-m-d 23:59:59", $timestamp));
				
		$sql_select = "SELECT * FROM appointments WHERE userid = '$userid' AND timestamp >= '$first_timestamp_of_day' AND timestamp <= '$last_timestamp_of_day'";
				
		foreach ($connection->query($sql_select) as $row) {			
			$appointmentname = $row['appointmentname'];
			$time = date('h:i', $row['timestamp']);
			$location = $row['location'];
			$comment = $row['comment'];
					
			if(empty($appointmentname)) {
				$pdf->SetFont('Arial','B',9);
				$pdf->Cell(170,5,'',0,1);
				$pdf->Cell(170,5,"Kein Termin",0,1);
			} else {			
				if($z < 1) {
					$pdf->SetFont('Arial','B',9);
					$pdf->Cell(170,5,'',0,1);
					$pdf->Cell(170,5,date("d.m.Y",$timestamp),0,1);
				}
				$z++;
				
				$pdf->SetFont('Arial','',9);
				$pdf->Cell(170,5,"$time Uhr: $appointmentname, $location ($comment)",0,1);
			}
		}
		
		$z = 0;
		$timestamp = strtotime('+1 day', $timestamp);
		
		$appointmentname = '';
	}

	$pdf->Output();
?>