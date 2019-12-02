<?php
require('../Method/method.php');
require('../Method/judUP.php');
$colum['driverId'] = $_POST['driverId'];
$colum['driverState'] = $_POST['driverState'];
$colum['driverBlock'] = $_POST['driverBlock'];
//司机被拉黑，直接禁用
if ($colum['driverBlock'] == 0) {
	$colum['driverState'] = 0;
}
$openState = new addInfo();
$openState->_connect();
$yes = $openState->_DriverState($colum);
if (!$yes) {
	echo "<script>alert('司机状态改变失败');history.back();</script>";
}
	echo "<script>alert('司机状态改变成功');location.href='./index.php'</script>";
