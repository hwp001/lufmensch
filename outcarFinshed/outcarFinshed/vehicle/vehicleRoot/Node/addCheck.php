<?php

require('../Method/method.php');
require('../Method/judUP.php');
$c = $_GET['c'];
$colum = array();
$colum['roleId'] = $_POST['roleId'];
$colum['loginState'] = $_POST['status'];
// $colum['loginIp'] = _getIp();
// $colum['loginTime'] = time();
//验证用户名， 密码， 验证用户姓名是否为中文字符
$verfiy = new Verify();
$userName =  $verfiy->isNames($_POST['userName']);
$colum['userName'] = $_POST['userName'];
if (!$userName) {
	   $up = new upLOG();
	   $up->_up('添加管理员',0);		
	echo "<script>alert('用户名格式出错，请重新填写');window.location.href='./add.php'</script>";die;
}
$userPwd = $verfiy->isPWD($_POST['userPwd']);
$colum['userPwd'] = $_POST['userPwd'];
if (!$userPwd) {
	   $up = new upLOG();
	   $up->_up('添加管理员',0);		
		echo "<script>alert('密码格式出错，请重新填写');window.location.href='./add.php'</script>";die;
}
$colum['userPwd'] = md5($colum['userPwd']);
$trueName = $verfiy->isTrueName($_POST['trueName']);
$colum['trueName'] = $_POST['trueName'];
if (!$trueName) {
	   $up = new upLOG();
	   $up->_up('添加管理员',0);	
		echo "<script>alert('真实姓名格式出错，请重新填写');window.location.href='./add.php'</script>";die;
}
$addNode = new addInfo();
$addNode->_connect();
if ($c == 1) {//增加管理员
	// var_dump(123123123);
	// var_dump($_FILES);die;
	$file = $_FILES['userImg']['tmp_name'];
	$fileName = $_FILES['userImg']['name'];
	$str = "headImg/".rand(1,pow(3, 10))."$fileName";
	if (is_uploaded_file($file)) {
		if (move_uploaded_file($file, $str)) {
			//echo "文件移动成功";
			$colum['userImg'] = $str;
		} else {
			//后面补充跳转回去
			die("文件移动失败,请重新选择头像");
		}
	} else {
		echo "<script>alert('请选择头像');history.back();</script>";die;
	}
	$Name = $addNode->_judName($colum['userName'],'vehicle_user');	
	if ($Name) {
	   $up = new upLOG();
	   $up->_up('添加管理员',0);			
		echo "管理员已经存在，请勿重复添加";die;
	}
	$yes =  $addNode->_insert($colum,'vehicle_user');
	if($yes){
	 echo "<script>alert('增加管理员成功');location.href='./index.php'</script>";	
	$up = new upLOG();
    $up->_up('添加管理员');
	}
}
elseif ($c == 2) {//编辑管理员
	$colum['userId'] = $_POST['userId'];
	 // var_dump($colum);die;
	$yes = $addNode->_update($colum,'vehicle_user');
	if (!$yes) {
		$up = new upLOG();
	   	$up->_up('编辑管理员信息',0);		
		echo "<script>alert('编辑管理员失败');history.back();</script>";die;	
	}
	$up = new upLOG();
    $up->_up('编辑管理员信息');
	echo "<script>alert('编辑管理员成功');location.href='./index.php'</script>";die;	

}
