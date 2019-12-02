<?php

require('../Method/method.php');
$delTable = new addInfo();
$delTable->_connect();
$yes = $delTable->_del($_GET['b'],'vehicle_log');
if (!$yes) {
	 $up = new upLOG();
	 $up->_up('删除日志',0);
echo "<script>alert('删除日志信息失败');window.location.href='./index.php'</script>";die;	 		
}
	 $up = new upLOG();
	 $up->_up('删除日志');
echo "<script>alert('删除日志信息成功');location.href='./index.php'</script>";
	




