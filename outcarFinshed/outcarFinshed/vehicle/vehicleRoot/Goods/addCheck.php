<?php

require('../Method/method.php');
$c = $_GET['c'];
$colum = array();
$colum['goodName'] = $_POST['goodName'];
$colum['goodNum'] = $_POST['goodNum'];
$addNode = new addInfo();
$addNode->_connect();
if ($c == 1) {//增加商品信息
	//商品被删除或者商品售空才能添加
	$colum['goodSales'] = 0;
	$colum['goodTrueNum'] = $_POST['goodNum'] * 0.98;
	$colum['goodState'] = $_POST['goodState'];
	$colum['addTime'] = time();
	$where = "where goodState = 1";
	$Name = $addNode->_judName($colum['goodName'],'vehicle_goods', $where);	
	if ($Name) {
		 $up = new upLOG();
		 $up->_up('添加商品',0);		
		echo "此商品已经存在，请勿重复添加";die;
	}
	$yes =  $addNode->_insert($colum,'vehicle_goods');
	if($yes){
	 echo "<script>alert('添加商品信息成功');location.href='./index.php'</script>";
	 $up = new upLOG();
     $up->_up('添加商品信息');	
	}

}
elseif ($c == 2) {//更改商品信息
	$colum['goodSales'] = $_POST['goodSales'];
	$colum['goodTrueNum'] = $_POST['goodTrueNum'];
	$colum['goodId'] = $_POST['goodId'];
	// var_dump($colum);die;	
	$yes = $addNode->_update($colum,'vehicle_goods');
	if (!$yes) {
		$up = new upLOG();
    	$up->_up('修改商品信息失败');
		echo "<script>alert('商品信息更改失败');history.back();</script>";	
	}
		$up = new upLOG();
    	$up->_up('修改商品信息成功');
		echo "<script>alert('商品信息更改成功');location.href='./index.php'</script>";	
	
}
