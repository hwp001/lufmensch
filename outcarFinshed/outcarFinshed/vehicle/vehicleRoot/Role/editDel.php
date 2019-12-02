<?php

require('../Method/method.php');
$delTable = new addInfo();
$delTable->_connect();
$yes = $delTable->_del($_GET['b'],'vehicle_role');
if (!$yes) {
	die("删除语句失败");
	$up = new upLOG();
	$up->_up('删除角色信息',0);	
}
echo "<script>alert('删除角色信息成功');location.href='./index.php'</script>";
   $up = new upLOG();
   $up->_up('删除角色信息');




