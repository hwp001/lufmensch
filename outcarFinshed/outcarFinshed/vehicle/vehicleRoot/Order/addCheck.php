<?php

require('../Method/method.php');
require('../Method/judUP.php');
$c = $_GET['c'];
// var_dump($_POST);die;
$colum = array();
$colum['goodId'] = trim($_POST['goodId']);
$colum['orderId'] = trim($_POST['orderId']);
$colum['carId'] = trim($_POST['carId']);
$colum['destination'] = trim($_POST['destination']);
$colum['goodCount'] = trim($_POST['goodCount']);
$colum['orderNum'] = trim($_POST['orderNum']); //订单号
$colum['existState'] = 1;
$str1 = $_POST['beginTime1'][0];
$str2 = $_POST['beginTime1'][1];
//判断时分格式范围s
if (!($str1 > 0 && $str1 < 24) || !($str2 > 0 && $str2 < 60)) {
	$up = new upLOG();
   	$up->_up('增加订单',0);		
	echo "<script>alert('时分格式出错，请重新填写');window.location.href='./add.php';</script>";die;
}
//除去前缀零
$verify = new Verify();
$str1 =  $verify->isNoZero($str1);
$str2 = $verify->isNoZero($str2);
$colum['beginTime'] = strtotime(trim($_POST['beginTime'])." ".$str1.".".$str2);
$colum['orderTiNum'] = rand(pow(2, 6),pow(5,9));//提货单号
$colum['createTime'] = time();
if ($colum['createTime'] > $colum['beginTime']) {
	$up = new upLOG();
   	$up->_up('增加订单',0);	
	echo "<script>alert('出发时间不能再订单生成时间之前');window.location.href='./add.php';</script>";die;
}
$addNode = new addInfo();
$addNode->_connect();
//判断订单商品的数量是否大于实际商品的数量
$where = "where goodId={$colum['goodId']} and delState = 1";
$res = $addNode->select('vehicle_goods',$where);
while (($row = $res->fetch_assoc()) && mysqli_affected_rows($addNode->mysqli)>0) {
	 $Yes = $row['goodTrueNum']-intval($colum['goodCount']);
	 // var_dump($Yes);die;
	if ($Yes<0) {
		$up = new upLOG();
	   	$up->_up('增加订单',0);		
		echo "<script>alert('订单货量超出，请重新输入，谢谢');window.location.href='./add.php';</script>";die;
	} else {
		if ($c == 1) {//增加订单
			$colum['createTime'] = time();	
			$Name = $addNode->_judName($colum['orderId'],'vehicle_order');	
			if ($Name) {
		   		$up = new upLOG();
   				$up->_up('增加订单',0);			
				echo "此订单已经存在，请勿重复添加";die;
			}
			$yes =  $addNode->_insert($colum,'vehicle_order');
			if($yes){			 
			 $good['goodId'] = $_POST['goodId'];
			 $good['goodName'] = $row['goodName'];
			 $good['goodNum'] = $row['goodNum'] - $colum['goodCount'];
			 $good['goodSales'] = $row['goodNum'] + $colum['goodCount'];
			 $good['goodTrueNum'] = $Yes;
			 $YES = $addNode->_update($good,'vehicle_goods');
			 //库存更新成功订单才能新建成功
			 if ($YES) {
			 		$res = $addNode->select('vehicle_goods',"where delState = 1 and goodId = {$good['goodId']}");			 	
			 		$row = $res->fetch_assoc();
			 		//var_dump($row);
			 		if ($row['goodTrueNum'] == 0) {
			 			$addNode->_goodNum($good['goodId']);
			 		}
			 	echo "<script>alert('新建订单成功');location.href='./index.php'</script>";
			 	$up = new upLOG();
    			$up->_up('增加订单信息');

			 	} else {
			 	echo "<script>alert('新建订单失败');history.back();</script>";
			 	$up = new upLOG();
    			$up->_up('增加订单信息',0);			 		
			 	}
	
			}
		} elseif ($c == 2) {//编辑订单

			$yes = $addNode->_update($colum,'vehicle_order');
			if($yes){
			 $good['goodId'] = $_POST['goodId'];
			 $good['goodName'] = $row['goodName'];
			 $good['goodNum'] = $row['goodNum'] - $colum['goodCount'];
			 $good['goodSales'] = $row['goodNum'] + $colum['goodCount'];
			 $good['goodTrueNum'] = $Yes;
			 $YES = $addNode->_update($good,'vehicle_goods');
			 if ($YES) {
			 	echo "<script>alert('更新订单信息成功');location.href='./index.php'</script>";
			 		$up = new upLOG();
    				$up->_up('更新订单信息');
			 	} else {
			 	echo "<script>alert('更新订单信息失败');history.back()</script>";
			 		$up = new upLOG();
    				$up->_up('更新订单信息',0);			 		
			 	}

			}

		}
}


}
