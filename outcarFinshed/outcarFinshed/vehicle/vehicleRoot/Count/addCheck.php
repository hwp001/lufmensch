<?php

require('../Method/method.php');
require('../Method/judUP.php');
$c = $_GET['c'];
$colum = array();
$colum['orderId'] = trim($_POST['orderId']);
$colum['orderState'] = $_POST['orderState'];
if ($c == 2) {//编辑订单状态
	$addNode = new addInfo();
	$addNode->_connect();
	$yes = $addNode->_orderState($colum);
	 if ($yes) {
		$up = new upLOG();
    	$up->_up('编辑订单状态信息');	 	
		echo "<script>alert('编辑订单状态信息成功');location.href='./index.php'</script>";

	} else {
		$up = new upLOG();
    	$up->_up('编辑订单状态信息',0);	 	
		echo "<script>alert('编辑订单状态信息失败');history.back();";		
	}
}