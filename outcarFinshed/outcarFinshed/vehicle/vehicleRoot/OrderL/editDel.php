<?php

require('../Method/method.php');
$delTable = new addInfo();
$delTable->_connect();
$yes = $delTable->_del($_GET['b'],'vehicle_order');
if (!$yes) {
   $up = new upLOG();
   $up->_up('删除订单',0);		
	die("删除语句失败");
}
echo "<script>alert('删除订单成功');location.href='./index.php'</script>";
   $up = new upLOG();
   $up->_up('删除订单');	




