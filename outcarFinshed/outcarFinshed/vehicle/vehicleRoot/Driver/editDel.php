<?php

require('../Method/method.php');
$delTable = new addInfo();
$delTable->_connect();
$yes = $delTable->_del($_GET['b'],'vehicle_drivers');
if (!$yes) {
$up = new upLOG();
$up->_up('删除司机信息',0);
echo "<script>alert('删除司机信息失败');history.back();</script>";
}
$up = new upLOG();
$up->_up('删除司机信息');
echo "<script>alert('删除司机信息成功');location.href='./index.php'</script>";
	




