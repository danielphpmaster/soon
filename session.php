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
	
	if (empty($_SESSION['searchvalue'])){
	 echo "";
	} else {
		$searchvalue = $_SESSION['searchvalue'];
	}
	
	if (empty($_SESSION['nm'])){
	 echo "";
	} else {
		$nm = $_SESSION['nm'];
	}
?>