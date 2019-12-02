<?php
	// include('../database.php');
	include('./Te.php');
	// var_dump($_POST['choose']);
	if (!isset($_POST['choose'])) {
		echo "<script>alert('请选择数据');history.back();</script>";
		die();
	}
	$data = $_POST['choose'];
	duoexport($data);
?>