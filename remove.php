<?php
	include 'inlcude_all.php';
	include 'loginwall.php';

	if(isset($_GET['a'])) {
		$entryid = $_GET['a'];
	}

	$sql_delete = "DELETE FROM entries WHERE entryid = '$entryid' and userid = '$userid'";
	$sql_delete = $connection->query($sql_delete);

	header('Location: '.$path.'calendar')
?>