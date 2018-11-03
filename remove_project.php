<?php
	include 'inlcude_all.php';
	include 'loginwall.php';

	if(isset($_GET['p'])) {
		$projecttoken = $_GET['p'];
	}

	$sql_delete = "DELETE FROM projects WHERE projecttoken = '$projecttoken' and usertoken = '$usertoken'";
	$sql_delete = $connection->query($sql_delete);

	header('Location: '.$path.'projects')
?>