<?php

require('../Method/method.php');
require('../Method/judUP.php');
$c = $_GET['c'];
// var_dump($_POST);die;
$colum = array();
$colum['carId'] = $_POST['carId'];
$colum['carLicense'] = $_POST['carLicense'];
$colum['contract'] = rand(pow(5, 10),pow(6, 6));
$colum['carState'] = $_POST['carState'];

$verify = new verify();
$sure = $verify->isCarLicense($colum['carLicense']);
if (!$sure) {
		$up = new upLOG();
    	$up->_up('增加车辆信息',0);		
	 	echo "<script>alert('车牌号格式出错');history.back();</script>";	die;		
}
$addNode = new addInfo();
$addNode->_connect();
if ($c == 1) {//增加车辆
	$Name = $addNode->_judName($colum['carLicense'],'vehicle_car');	
	if ($Name) {
		$up = new upLOG();
    	$up->_up('增加车辆信息',0);		
		echo "此车牌号已经存在，请勿重复添加";die;
	}
	$yes =  $addNode->_insert($colum,'vehicle_car');
	if(!$yes){
		$up = new upLOG();
    	$up->_up('增加车辆信息',0);		
		echo "<script>alert('增加车辆信息失败');history.back();</script>";die;
	}
		$up = new upLOG();
    	$up->_up('增加车辆信息',1);		
		echo "<script>alert('增加车辆信息成功');location.href='./index.php'</script>";
}
elseif ($c == 2) {//编辑车辆
	$colum['carId'] = $_POST['carId'];
	$yes = $addNode->_update($colum,'vehicle_car');
	if(!$yes){
		$up = new upLOG();
    	$up->_up('更改车辆信息',0);		
	 	echo "<script>alert('更改车辆信息失败');history.back();</script>";die;	
	}
		$up = new upLOG();
    	$up->_up('增加车辆信息');	
		echo "<script>alert('更改车辆信息成功');location.href='./index.php'</script>";
}
