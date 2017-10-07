<?php
	/* Verbindung zur Datenbank (lokal) */
		$servername = 'localhost';
		$user = 'root';
		$pw = '';
		$db = 'soon';
		$connection = new PDO('mysql:host=localhost;dbname=soon', 'root', '');

	/* Verbindung zur Datenbank (beim Server)
		$servername = 'localhost:3306';
		$user = 'sooncalroot';
		$pw = '';
		$db = 'soon';
		$connection = new mysqli($servername, $user, $pw, $db);
	*/
?>