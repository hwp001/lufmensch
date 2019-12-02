<?php

require('../Method/method.php');
$delTable = new addInfo();
$delTable->_connect();
$yes = $delTable->_del($_GET['b'],'vehicle_goods');
if (!$yes) {
$up = new upLOG();
$up->_up('删除商品信息',0);	
echo "<script>alert('删除商品信息成功');history.back()</script>";die;
}
echo "<script>alert('删除商品信息成功');location.href='./index.php'</script>";
$up = new upLOG();
$up->_up('删除商品信息');	




