<?php
	// Verbindung zur Datenbank
		class db {
		public static $link;
    }

    db::$link = new mysqli('localhost', 'root', '', 'soon');
?>