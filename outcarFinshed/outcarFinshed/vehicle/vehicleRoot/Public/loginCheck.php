<?php
session_start();
require('../Method/method.php');
require('../Method/judUP.php');
$loginCheck = new mysqlLoginCheck();
$loginCheck->_connect();

$verify = new Verify();
$name = $verify->isNames($_POST['userName']);
if (!$name) {
	echo "<script>alert('用户名格式错误,请重新输入');history.back();</script>";die;
}
$pwd = $verify->isPWD($_POST['userPwd']);
if (!$pwd) {
	echo "<script>alert('密码格式错误,请重新输入');history.back();</script>";die;
}
$loginCheck->_checkLogin($_POST['userName'], $_POST['userPwd']);

