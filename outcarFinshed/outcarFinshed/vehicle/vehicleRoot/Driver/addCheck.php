<?php

require('../Method/method.php');
require('../Method/judUP.php');
//把图片转移到本地路径
if (empty($_POST['driverName']) || empty($_POST['driverPhone']) || empty($_POST['driverPwd'])) {
	echo "<script>alert('用户信息不能为空，请重新输入');history.back();</script>";
}else{
$colum = array();
$colum['driverName'] = trim($_POST['driverName']);
$colum['driverPhone'] = trim($_POST['driverPhone']);
$colum['driverPwd'] = trim($_POST['driverPwd']);
$colum['applyDate'] = time();

//验证用户名， 密码， 验证用户姓名是否为中文字符
$verfiy = new Verify();
$driverPhone =  $verfiy->isMobile($colum['driverPhone']);
if (!$driverPhone) {
	 	$up = new upLOG();
    	$up->_up('增加司机信息',0);	
		echo "<script>alert('手机号格式出错，请重新填写');history.back();</script>";die;
}

$driverPwd = $verfiy->isPWD($colum['driverPwd']);
if (!$driverPwd) {
	 	$up = new upLOG();
    	$up->_up('增加司机信息',0);	
		echo "<script>alert('密码格式出错，请重新填写');history.back();</script>";die;
}
$colum['driverPwd'] =md5($colum['driverPwd']);

$driverName = $verfiy->isTrueName($colum['driverName']);
if (!$driverName) {
	 	$up = new upLOG();
    	$up->_up('增加司机信息',0);		
		echo "<script>alert('真实姓名格式出错，请重新填写');history.back();</script>";die;
}

$addNode = new addInfo();
$addNode->_connect();

if ($_GET['c'] == 1) {
//排除相同账号
	$phone = $addNode->_judPhone($colum['driverPhone']);
	if (!$phone) {
			echo "<script>alert('此账号已经存在，请勿重复添加');history.back();</script>";die;	
	}
	$colum['driverState'] = $_POST['driverState'];
	$colum['driverBlock'] = $_POST['driverBlock'];
	//司机被拉黑，直接禁用
	if ($colum['driverBlock'] == 0) {
		$colum['driveState'] == 0;
	}
	$file = $_FILES['driverImg']['tmp_name'];
	$fileName = $_FILES['driverImg']['name'];
	$str = "headImg/".rand(1,pow(3, 10))."$fileName";
	if (is_uploaded_file($file)) {
		if (move_uploaded_file($file, $str)) {
			//echo "文件移动成功";
			$colum['driverImg'] = $str;
		} else {
			//后面补充跳转回去
			die("文件移动失败,请重新选择头像");
		}
	} else {
		echo "<script>alert('请选择头像');history.back();</script>";die;
	}

	$Name = $addNode->_judName($colum['driverName'],'vehicle_drivers');	
	if ($Name) {
	 	$up = new upLOG();
    	$up->_up('增加司机信息',0);			
		echo "<script>alert('司机已经存在，请勿重复添加');history.back();</script>";die;
	}
	$yes =  $addNode->_insert($colum,'vehicle_drivers');
	if($yes){
	 	echo "<script>alert('增加司机信息成功');location.href='./index.php'</script>";
	 	   $up = new upLOG();
    		$up->_up('增加司机信息');
	} else {
	 	echo "<script>alert('增加司机信息失败');history.back()</script>";
	 	   $up = new upLOG();
    		$up->_up('增加司机信息',0);		
	}	
} elseif ($_GET['c'] == 2) {
	//编辑司机信息
	$phone = $addNode->_judPhone($colum['driverPhone']);
	if ($phone == 2) {
			echo "<script>alert('此账号已经存在，请勿重复添加');history.back();</script>";die;	
	}	
	$addNode = new addInfo();
	$addNode->_connect();
	$colum['driverId'] = $_POST['driverId'];
	// var_dump($colum); 补充添加一个姓名唯一
	$ye =$addNode->_update($colum,'vehicle_drivers');
		if($ye){
	 	echo "<script>alert('修改司机信息成功');location.href='./index.php'</script>";
	 		 $up = new upLOG();
    		$up->_up('修改司机信息');
	} else {
	 	echo "<script>alert('修改司机信息失败');history.back();</script>";
	 		 $up = new upLOG();
    		$up->_up('修改司机信息',0);		
	}
}


}

