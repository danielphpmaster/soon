<?php
	include 'inlcude_all.php';
	include 'loginwall.php';

	if(isset($_GET['p'])) {
		$goalid = $_GET['p'];
	}

	$sql_delete = "DELETE FROM goals WHERE goalid = '$goalid' and userid = '$userid'";
	$sql_delete = $connection->query($sql_delete);

	$sql_update = "UPDATE entries SET goalid = 'false' WHERE goalid = '$goalid' and userid = '$userid'";
	$sql_update = $connection->query($sql_update);

	header('Location: '.$path.'goals')
?>