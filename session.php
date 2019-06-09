<?php
	session_start();

	if(isset($_SESSION['email'])){
		$email = $_SESSION['email'];
	}
	if(isset($_SESSION['username'])){
		$username = $_SESSION['username'];
	}
	if(isset($_SESSION['userid'])){
		$userid = $_SESSION['userid'];
	} else {
	}	
	if(isset($_SESSION['searchvalue'])){
		$searchvalue = $_SESSION['searchvalue'];
	}		
	if(isset($_SESSION['entryid'])){
		$entryid = $_SESSION['entryid'];
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