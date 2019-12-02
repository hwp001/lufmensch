<?php

require('../Method/method.php');
$delTable = new addInfo();
$delTable->_connect();
$yes = $delTable->_del($_GET['b'],'vehicle_user');
if (!$yes) {
   $up = new upLOG();
   $up->_up('删除管理员',0);		
	echo "<script>alert('删除管理员失败');history.back()</script>";die;
}
   $up = new upLOG();
   $up->_up('删除管理员');
	echo "<script>alert('删除管理员成功');location.href='./index.php'</script>";
	




