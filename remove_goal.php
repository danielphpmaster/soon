<?php
	include 'inlcude_all.php';
	include 'loginwall.php';

	if(isset($_GET['p'])) {
		$goaltoken = $_GET['p'];
	}

	$sql_delete = "DELETE FROM goals WHERE goaltoken = '$goaltoken' and usertoken = '$usertoken'";
	$sql_delete = $connection->query($sql_delete);

	header('Location: '.$path.'goals')
?>