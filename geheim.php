<?php
session_start();
if(!isset($_SESSION['userid'])) {
 die(header('Location: index.php'));
}

//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];

echo "Hallo User: ".$userid;
?>
