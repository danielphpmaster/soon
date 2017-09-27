<?php

/* Verbindung zur Datenbank (lokal) */
	$servername = 'localhost';
	$user = 'root';
	$pw = '';
	$db = 'soon';
	$connection = new mysqli($servername, $user, $pw, $db);

	/* Verbindung zur Datenbank (beim Server)
	$servername = 'localhost:3306';
	$user = 'sooncalroot';
	$pw = '';
	$db = 'soon';
	$connection = new mysqli($servername, $user, $pw, $db);
	*/
	
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);	
}
?>