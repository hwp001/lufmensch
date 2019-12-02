<?php
require('../Method/method.php');
session_start();
if (!isset($_SESSION['driverId'])) {
	echo "<script>alert('请登录');location.href='../login/index.php'</script>";
}
$colum['driverId'] = $_SESSION['driverId'];
$colum['goodTrueCount'] = $_POST['goodTrueCount'];
$colum['orderId'] = $_POST['orderId'];
$colum['beginTime'] = $_POST['beginTime'];
if (!isset($colum['goodTrueCount']) || $colum['goodTrueCount'] == '') {
	echo "<script>alert('实际货量不能为空，请重新填写');window.location.href='./car1.php?a={$colum['orderId']}';</script>";die;
}
$carOrder = new addInfo();
$carOrder->_connect();
$where = "where orderId = {$colum['orderId']} and delState = 1 and existState = 1";
$res = $carOrder->select('vehicle_order', $where);
$row = $res->fetch_assoc();
if ($colum['goodTrueCount'] > $row['goodCount']) {
	echo "<script>alert('实际货量不能超过提货量，请重新填写');window.location.href='./car1.php?a={$colum['orderId']}';</script>";die;
}
if ($colum['goodTrueCount'] < 0) {
	echo "<script>alert('实际货量不能为负数，请重新填写，谢谢');window.location.href='./car1.php?a={$colum['orderId']}';</script>";die;
}
$res->free();
$yes = $carOrder->_update($colum,'vehicle_order');
if (!$yes) {
	echo "<script>alert('填写有误，请重新填写');window.location.href='./car1.php?a={$colum['orderId']}';</script>";die;
}
   $up = new upLOG();
    $up->_up('成功接单');
echo "<script>alert('接单成功，正在送货中');location.href='./car2.php?a={$colum['orderId']}';</script>";
