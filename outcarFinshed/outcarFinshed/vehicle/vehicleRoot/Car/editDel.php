<?php

require('../Method/method.php');
$delTable = new addInfo();
$delTable->_connect();
$yes = $delTable->_del($_GET['b'],'vehicle_car');
if (!$yes) {
	die("删除语句失败");
}
echo "<script>alert('删除车辆信息成功');location.href='./index.php'</script>";
	




