<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>订单细节</title>
	<link rel="stylesheet" href="./order.css">
	<link rel="stylesheet" href="./iconfont.css">
</head>
<body>

<?php
require('../Method/method.php');
session_start();
$orderId = $_GET['a'];
$orderDriver = @$_SESSION['driverName'];
$driverImg = @$_SESSION['driverImg'];
$driverImg ="../../vehicleRoot/Driver/"."{$driverImg}";
$driverPhone = @$_SESSION['driverPhone'];
$carFound = new mysqlCon();
$carFound->_connect();
$table = "vehicle_order as a,vehicle_car as b,vehicle_goods as c";
$where = "where orderId = {$orderId} and a.goodId = c.goodId and b.carId = a.carId and a.delState = 1";
$res = $carFound->select($table,$where);
$row = $res->fetch_assoc();
$row['beginTime'] = date('Y.m.d H:i',$row['beginTime']);	
$row['createTime'] = date('Y.m.d H:i',$row['createTime']);
echo "<div class='header'></div>
		<div class='content'>
			<div class='content_user'>
				<div class='content_user_details1'><img src='{$driverImg}
				' width='250px' height='250px' />					
				</div>
				<div class='content_user_details2'>
					{$driverPhone}
				</div>
			</div>
			<div class='content-details'>
				<div class='content_details1'><span class='iconfont icon-chepai'></span>&nbsp;车牌号</div>
				<div class='content_details2'>{$row['carLicense']}</div>
				<div class='content_details3'><span class='iconfont icon-zhuangtai'></span>&nbsp;订单状态</div>
				<div class='content_details4'>未接单</div>
			</div>
			<div class='content-details'>
				<div class='content_details1'><span class='iconfont icon-shangpin'></span>&nbsp;商品</div>
				<div class='content_details2'>{$row['goodName']}</div>
				<div class='content_details3'><span class='iconfont icon-shuliang'></span>&nbsp;数量</div>
				<div class='content_details4'>{$row['goodCount']}吨</div>
			</div>
			<div class='content-details'>
				<div class='content_details1'><span class='iconfont icon-shijian'></span>&nbsp;出发时间</div>
				<div class='content_details2'>{$row['beginTime']}</div>
				<div class='content_details3'><span class='iconfont icon-chuangjian'></span>&nbsp;订单创建时间</div>
				<div class='content_details4'>{$row['createTime']}</div>
			</div>
			<div class='content-details'>
				<div class='content_details1'><span class='iconfont icon-didian'></span>&nbsp;目的地</div>
				<div class='content_details2'>{$row['destination']}</div>
			</div>
			<div class='content-details'>
				<div class='content_details1'><span class='iconfont icon-hetong'></span>&nbsp;合同号</div>
				<form action='../carDetail/readyCheck.php?a={$row['orderId']}' method='post'>
				<input type='hidden' name='correct' value='{$row['contract']}'>
				<input class='content_details7' type='text' placeholder='请输入合同号' name= 'contract'>
				<div class='content_details3'><span class='iconfont icon-bianhao'></span>&nbsp;订单编号</div>
				<div class='content_details4'>{$row['orderId']}</div>
			</div>
		</div>


		<div class='footer'>
			<input class='footer_order' type='submit' value='接单'>
		</div>
		</form>"
?>

</body>
</html>