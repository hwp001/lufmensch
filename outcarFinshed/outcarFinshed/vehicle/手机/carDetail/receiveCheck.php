<?php
require('../Method/method.php');
$orderId = $_GET['a'];
$orderTiNum = $_POST['orderTiNum'];
$jud = new addInfo();
$jud->_connect();
$OrderTiNum = $jud->_judId($orderId,'vehicle_order');
if ($OrderTiNum == $orderTiNum) {
	echo "<script>alert('提货已完成，准备进入出车细节');window.location.href='./car1.php?a={$orderId}';</script>";
} else {
	echo "<script>alert('提货单号不匹配，请重新填写');window.location.href='./receiveCar.php?a={$orderId}';</script>";

}
