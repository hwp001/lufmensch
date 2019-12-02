<?php
require('../Method/method.php');
session_start();
$colum['orderId'] = $_GET['a'];
$colum['contract'] = trim($_POST['contract']);
$colum['correct'] = trim($_POST['correct']);
if (!isset($colum['contract']) || $colum['contract'] == '') {
	echo "<script>alert('合同号不能为空，请重新填写');window.location.href='../needOrder/needOrder.php?a={$colum['orderId']}';</script>";
}
if ($colum['correct'] == $colum['contract']) {
	 $up = new upLOG();
    $up->_up('正在接单');
	echo "<script>alert('合同号匹配成功，请完善出车细节');window.location.href='./receiveCar.php?a={$colum['orderId']}';</script>";

} else {
		echo "<script>alert('合同号匹配失败，请重新填写');window.location.href='../needOrder/needOrder.php?a={$colum['orderId']}';</script>";

}
