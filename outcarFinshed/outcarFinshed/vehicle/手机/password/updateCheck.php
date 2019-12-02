<?php
session_start();
require('../Method/method.php');
require('../Method/judUP.php');
$driverPwd = trim($_POST['driverPwd']);
$newpass1 = trim($_POST['newpass1']);
$newpass2 = trim($_POST['newpass2']);

$verify = new Verify();
$pwd1 = $verify->isPWD($driverPwd);
$pwd2 = $verify->isPWD($newpass1);
$pwd3 = $verify->isPWD($newpass2);
if (!$pwd1) {
	echo "<script>alert('原密码格式错误');window.location.href='./index.php'</script>";die;
}
if (!$pwd2) {
	echo "<script>alert('新密码格式错误');window.location.href='./index.php'</script>";die;
}
if (!$pwd3) {
	echo "<script>alert('重新输入密码格式错误');window.location.href='./index.php'</script>";die;
}
if (($driverPwd == $newpass1) || ($driverPwd == $newpass2)) {
	echo "<script>alert('原密码和更新密码一致，请重新填写');window.location.href='./index.php'</script>";die;
}

if ($newpass1 != $newpass2) {
	echo "<script>alert('更新密码不一致');window.location.href='./index.php'</script>";die;
}
$driverPwd = md5($driverPwd);
$pwd = new pass();
$pwd->_connect();
//判断原密码是否存在
$yes = $pwd->judpass($driverPwd);
if (!$yes) {
	echo "<script>alert('原密码错误');window.location.href='./index.php';</script>";die;
}

$new = md5($newpass1);
$Yes = $pwd->updatePass($new);

if ($Yes) {
	echo "<script>alert('密码更改成功');window.location.href='../myself/myself.php';</script>";
	  $up = new upLOG();
    $up->_up('修改密码');
}