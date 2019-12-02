<?php

require('../Method/method.php');
$delTable = new addInfo();
$delTable->_connect();
$yes = $delTable->_del($_GET['b'],'vehicle_drivers');
if (!$yes) {
	die("删除语句失败");
}
echo "<script>alert('删除司机信息成功');location.href='./index.php'</script>";
	




