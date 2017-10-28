<?php
	// Verbindung zur Datenbank
		$connection = new PDO('mysql:host=localhost;dbname=soon', 'root', '');
	
		class db {
		public static $link;
    }

    db::$link = new mysqli('localhost', 'root', '', 'soon');

?>