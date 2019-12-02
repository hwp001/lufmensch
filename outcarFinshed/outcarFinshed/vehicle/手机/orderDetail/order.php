<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>订单细节111</title>
	<link rel="stylesheet" href="./order.css">
	<link rel="stylesheet" href="./iconfont.css">
</head>
<body>
<?php
session_start();
$ordersId = $_SESSION['ordersId'];
$driverImg = $_SESSION['driverImg'];
require('../Method/method.php');
$found = new addInfo();
$found->_connect();
$where ="where ordersId = {$ordersId} and delState = 1";
$res = $found->select('vehicle_orders',$where);
$row = $res->fetch_assoc();
?>
	<div class="header"></div>
	<div class="content">
		<div class="content_user">
			<div class="content_user_details1"><img src="<?php echo $driverImg;?>" style="width: 200px;height: 250px;"></div>
			<div class="content_user_details2"><?php echo $row['driverPhone']; ?></div>
		</div>
		<div class="content-details">
			<div class="content_details1"><span class="iconfont icon-chepai"></span>&nbsp;车牌号</div>
			<div class="content_details2"><?php echo $row['carLicense'];?></div>


<?php
//默认传值 订单编号
$orderId = $_SESSION['orderId'];
$where ="where orderId = {$orderId} and delState = 1";
$res = $found->select('view_order',$where);
$row = $res->fetch_assoc();
?>



			<div class="content_details3"><span class="iconfont icon-zhuangtai"></span>&nbsp;订单状态</div>
			<div class="content_details4"><?php echo $row['orderState']; ?></div>
		</div>
		<div class="content-details">
			<div class="content_details1"><span class="iconfont icon-shangpin"></span>&nbsp;商品</div>
			<div class="content_details2"><?php echo $row['goodName']; ?></div>
			<div class="content_details3"><span class="iconfont icon-shuliang"></span>&nbsp;数量</div>
			<div class="content_details4"><?php echo $row['goodCount']; ?></div>
		</div>
		<div class="content-details">
			<div class="content_details1"><span class="iconfont icon-shijian"></span>&nbsp;出发时间</div>
			<div class="content_details2"><?php echo $row['beginTime']; ?></div>
			<div class="content_details3"><span class="iconfont icon-chuangjian"></span>&nbsp;订单创建时间</div>
			<div class="content_details4"><?php echo $row['createTime']; ?></div>
		</div>
		<div class="content-details">
			<div class="content_details5"><span class="iconfont icon-didian"></span>&nbsp;目的地</div>
			<div class="content_details6"><?php echo $row['destination']; ?></div>
		</div>
		<div class="content-details">
			<div class="content_details1"><span class="iconfont icon-hetong"></span>&nbsp;合同号</div>
			<div class="content_details2">合同号</div>
			<div class="content_details3"><span class="iconfont icon-bianhao"></span>&nbsp;订单编号</div>
			<div class="content_details4"><?php echo $row['orderId']; ?></div>
		</div>
	</div>
	<div class="footer">
		<div class="footer_order">接单</div>
	</div>


?>
</body>
</html>