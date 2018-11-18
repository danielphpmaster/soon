<?php
	session_start();

	if(isset($_SESSION['email'])){
		$email = $_SESSION['email'];
	}
	if(isset($_SESSION['username'])){
		$username = $_SESSION['username'];
	}
	if(isset($_SESSION['usertoken'])){
		$usertoken = $_SESSION['usertoken'];
	} else {
	}	
	if(isset($_SESSION['searchvalue'])){
		$searchvalue = $_SESSION['searchvalue'];
	}		
	if(isset($_SESSION['appointmenttoken'])){
		$appointmenttoken = $_SESSION['appointmenttoken'];
	}		
	if(isset($_SESSION['goaltoken'])){
		$goaltoken = $_SESSION['goaltoken'];
	}	
	if(isset($_SESSION['language'])){
		$language = $_SESSION['language'];
	}	
	if(isset($_SESSION['email_verified'])){
		$email_verified = $_SESSION['email_verified'];
	}
	if(isset($_SESSION['view'])){
		$view = $_SESSION['view'];
	}
?>