<?php
	include 'inlcude_all.php';
	include 'loginwall.php';		
	require_once('fpdf181/fpdf.php');
	
	$t_headline = array(
		"Alle deine Termine - immer und überall aufrufbar",
		"All your appointments. Anytime, everywhere"
	);
	
	if(empty($_GET['year'])) {
		$year = date('Y');
	} else {
		$year = $_GET['year'];
	}
	
	if(empty($_GET['month'])) {
		$month = date('F');
	} else {
		$month = $_GET['month'];
	}

	$timestamp = strtotime("$year $month");
	
	if($timestamp < strtotime(date('Y-m-01'))) {
		$year = date('Y');
		$month = date('F');
		header('Location: '.$path.'calendar/'.$year.'/'.$month.'');
	}
	
	if($timestamp > strtotime(date('2019-12-01'))) {
		$year = date('Y');
		$month = date('F');
		header('Location: '.$path.'calendar/'.$year.'/'.$month.'');
	}

	$timestamp_of_month = strtotime(date("Y-m-1 00:00", $timestamp));
	$last_day_of_month = strtotime(date("Y-m-t 24:00", $timestamp_of_month));
	
	// Definierung heutiges Datumformat
	$t_day = 't_day_'.date("N", time());
	$t_month = 't_month_'.date("n", time());
		
	$t_date_format_today = array(
		date("d. ", time()).${$t_month}[$language].date(" Y", time()), 
		${$t_month}[$language].date(" d Y", time())
	);
	
	// Definierung Datumformat
		$t_day = 't_day_'.date("N", $timestamp);
		$t_month = 't_month_'.date("n", $timestamp);
			
		$t_date_format = array(
			${$t_month}[$language].date(" Y", $timestamp), 
			${$t_month}[$language].date(" Y", $timestamp)
		);

	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->Image('images/logo.png',11.5,10,30);

	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(170,10,'',0,1);
	$pdf->Cell(36,15,"www.soon-calendar.ch",0,0);

	$pdf->SetFont('Arial','',9);
	$pdf->Cell(170,15,"$t_headline[$language].",0,1);

	$pdf->Cell(170,15,"$t_all_appointments_of[$language] $username $t_in[$language] $t_date_format[$language]. $t_created_on[$language] $t_date_format_today[$language].",0,1);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(170,15,"$t_date_format[$language]",0,1);
	
	
	while($timestamp < $last_day_of_month) {
		// Definierung Datumformat
		$t_day = 't_day_'.date("N", $timestamp);
		$t_month = 't_month_'.date("n", $timestamp);
			
		$t_date_format = array(
			${$t_day}[$language].", ".date("d. ", $timestamp).${$t_month}[$language], 
			${$t_day}[$language].", ".${$t_month}[$language].date(" d", $timestamp)
		);
				
		$first_timestamp_of_day = strtotime(date("Y-m-d 00:00:00", $timestamp));
		$last_timestamp_of_day = strtotime(date("Y-m-d 23:59:59", $timestamp));
				
		$sql_select = "SELECT * FROM appointments WHERE usertoken = '$usertoken' AND timestamp >= '$first_timestamp_of_day' AND timestamp <= '$last_timestamp_of_day'";
				
		foreach ($connection->query($sql_select) as $row) {
			// Definierung Zeitformat
			$t_time = array(
				date('G:i', $row['timestamp'])." Uhr",
				date('g.i a', $row['timestamp'])
			);
			
			$appointmentname = openssl_decrypt($row['appointmentname'],"AES-128-ECB",$key);
			$location = openssl_decrypt($row['location'],"AES-128-ECB",$key);
			$comment = openssl_decrypt($row['comment'],"AES-128-ECB",$key);
			
			if($z < 1) {
				$pdf->SetFont('Arial','B',9);
				$pdf->Cell(170,5,'',0,1);
				$pdf->Cell(170,5,$t_date_format[$language],0,1);
			}
			$z++;
			
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(170,5,"$t_time[$language]: $appointmentname, $location, $comment",0,1);			
		}
		
		$z = 0;
		$timestamp = strtotime('+1 day', $timestamp);
		
		$appointmentname = '';
	}

	$pdf->Output();
?>