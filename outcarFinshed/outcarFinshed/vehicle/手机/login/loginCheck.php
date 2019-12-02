<?php
session_start();
require('../Method/method.php');
require('../Method/judUP.php');
$loginCheck = new mysqlLoginCheck();
$loginCheck->_connect();
$verify = new Verify();
$name = $verify->isMobile($_POST['driverPhone']);
if (!$name) {
	echo "<script>alert('手机号格式错误,请重新输入(+86/13/15开头)');history.back();</script>";die;
}
$pwd = $verify->isPWD($_POST['driverPwd']);
if (!$pwd) {
	echo "<script>alert('密码格式错误,请重新输入');history.back();</script>";die;
}

$_SESSION['lin'] = $_POST['driverPhone'];
$loginCheck->_checkLogin($_POST['driverPhone'], $_POST['driverPwd']);