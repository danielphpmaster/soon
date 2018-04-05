<?php
	session_start();

	if (empty($_SESSION['email'])){
		echo "";
	} else {
		$email = $_SESSION['email'];
	}

	if (empty($_SESSION['username'])){
		echo "";
	} else {
		$username = $_SESSION['username'];
	}

	if (empty($_SESSION['userid'])){
		echo "";
	} else {
		$userid = $_SESSION['userid'];
	}
	
	if (empty($_SESSION['usertoken'])){
		echo "";
	} else {
		$usertoken = $_SESSION['usertoken'];
	}
	
	if (empty($_SESSION['searchvalue'])){
		echo "";
	} else {
		$searchvalue = $_SESSION['searchvalue'];
	}
		
	if (empty($_SESSION['appointmenttoken'])){
		echo "";
	} else {
		$appointmenttoken = $_SESSION['appointmenttoken'];
	}
	
	if (empty($_SESSION['language'])){
		echo "";
	} else {
		$language = $_SESSION['language'];
	}
	if (empty($_SESSION['email_verified'])){
		echo "";
	} else {
		$email_verified = $_SESSION['email_verified'];
	}
?>