<?php

require('../Method/method.php');
require('../Method/judUP.php');

if (empty($_POST['roleName'])) {
	echo "<script>alert('角色名称不能为空');history.back();</script>";
}
//大权限
$colum['rootName'] = '';
if (!empty($_POST['group'])) {
	$colum['rootName'] .= implode('@', $_POST['group']);
}
//间隔连接
$colum['rootName'] .= '@';
//小权限
if (!empty($_POST['node'])) {
	$colum['rootName'] .= implode('@', $_POST['node']);	
}
$verify = new Verify();
$yes = $verify->isRoleName($_POST['roleName']);
if (!$yes) {
	echo "<script>alert('角色名格式错误，请重新填写');history.back();</script>";die;
}
$colum['roleState'] = $_POST['roleState'];
$colum['roleName'] = $_POST['roleName'];
$colum['addTime'] = time();
$c = $_GET['c'];
$addRole = new addInfo();
$addRole->_connect();
//添加
if ($c == 1) {

	$Name = $addRole->_judName($colum['roleName'],'vehicle_role');
	if ($Name) {
			   $up = new upLOG();
	    		$up->_up('添加角色信息',0);		
			echo "<script>alert('角色名已经存在，请重新填写');history.back();</script>";die;
	}
	$yes = $addRole->_insert($colum,'vehicle_role');
	if ($yes) {
			echo "<script>alert('角色创建成功');location.href='./index.php';</script>";
			$up = new upLOG();
	    	$up->_up('添加角色信息');
	}else {
			echo "<script>alert('添加角色失败');history.back()</script>";
			$up = new upLOG();
    		$up->_up('添加角色信息',0);	
	} 
}elseif ($c == 2) {
	$colum['updateTime'] = time();
	$colum['roleId'] = $_POST['roleId'];
	$yes = $addRole->_update($colum,'vehicle_role');
	if ($yes) {
			echo "<script>alert('编辑角色信息成功');location.href='./index.php';</script>";
			$up = new upLOG();
	    	$up->_up('编辑角色信息');		
	} else {
			echo "<script>alert('编辑角色信息失败');history.back();</script>";
			$up = new upLOG();
	    	$up->_up('编辑角色信息',0);		

	}

}