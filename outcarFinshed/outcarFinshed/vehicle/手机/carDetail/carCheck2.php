<?php
session_start();
require('../Method/method.php');
$colum['driverId'] = $_SESSION['driverId'];
$colum['orderId'] = $_POST['orderId'];
$colum['beginTime'] = $_POST['beginTime'];
$colum['lastTime'] = time();
if ($colum['beginTime'] > $colum['lastTime']) {
	echo "<script>alert('到达时间不能在出发时间之前');window.location.href='./car2.php?a={$colum['orderId']}'</script>";
}
$carOrder = new addInfo();
$carOrder->_connect();
$yes = $carOrder->_update($colum,'vehicle_order',2);
if (!$yes) {
	echo "<script>alert('填写有误，请重新填写');window.location.href='./car2.php?a={$colum['orderId']};</script>";die;
}
   $up = new upLOG();
   $up->_up('送达订单');
//确定送达可以接单
echo "<script>alert('订单确定送达');location.href='../order/myOrder.php';</script>";
