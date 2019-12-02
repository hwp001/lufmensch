<?php
require('../Method/method.php');

$carDel = $_POST['carDel'];
$addD = new addInfo();
$addD->_connect();
if (count($carDel) == 0) {
	echo "<script>alert('请返回勾选需要删除的内容');history.back();</script>";
}
if (count($carDel) ==1) {
	$yes = $addD->_del($carDel[0],'vehicle_car');
	if (!$yes) {
		die("删除语句失败");
	}
	echo "<script>alert('删除车辆信息成功');location.href='./index.php'</script>";
}
if (count($carDel) >1 ) {	
	$str = '';
foreach ($carDel as $key => $value) {
	$str .="carId = {$value} or ";
}
$where ="where ".substr($str, 0, strrpos($str, 'o')-1)." and delState = 1";
	$state = $addD->_allDel($where);
	if (!$state) {
		echo "<script>alert('删除车辆信息失败');history.back();</script>";die;		
	}
		echo "<script>alert('删除车辆信息成功');location.href='./index.php'</script>";

}


