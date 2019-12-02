<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv="refresh" content="60">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<title>车辆运货预约</title>
	<script type="text/javascript" src="../js/flexible.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/index.css">
	<link rel="stylesheet" type="text/css" href="../css/jquery-weui.min.css">
    <link rel="stylesheet" type="text/css" href="../css/weui.min.css">
    <link rel="stylesheet" type="text/css" href="./index.css">
	<link rel="stylesheet" type="text/css" href="font/iconfont.css">
</head>
<body>
	<div id="main" style="height: 764px;">
		<div id="box" class="box" v-show="boxDp">
			<div id="wrap" class="wrap">
			    <div id="start" class="start">
			        <span>告示：</span>请把微信姓名改成真实姓名
			    </div>
			</div>
		</div>
		<div id="top">
			<img src="../images/banner.png" class="topImg">
			<div class="search" style="position: relative;top: 10px;">
				<div class="searchCon">
					<form action="#" method="post">
					<input type="text" name="key" placeholder="请输入你想搜索的内容" class="weui-input" style="">
					<div class="refresh">
						<input type="submit" name="" style="position:absolute;right: 40px; width: 40px;height: 37px;" value="搜索">						
						<input type="button" onclick="refresh()" name="" style="position:absolute;right: 4px; width: 40px;height: 37px;" value="刷新">
					</div>
					</form>
				</div>
			</div>
		</div>
<?php
session_start();
require('./test.php');
$count = new mysqlCon();
$count->_connect();
$where = "where driverId = {$_SESSION['driverId']} and delState = 1 and orderState = 1";
$count->select('vehicle_order',$where);
$number = 0;
if (mysqli_affected_rows($count->mysqli)>0) {
	$number = 2;
}


$key = (!isset($_POST['key']))?'nobody':$_POST['key'];
$key = trim($key);
$found = new dimF();
$found->_connect();
$where = "";
$res = $found->select('view_c',$where);
$row = $res->fetch_row();
$i = $row[0];//订单总数
$res->free();
$res = $found->_select($key,'view_ordert');
?>

		<div class="list" style="height: 500px;">

<?php

$color = '';
$num = mysqli_affected_rows($found->mysqli);
if ($num>0) {
while ($row = $res->fetch_assoc()) { 
	$row['beginTime'] = date("Y-m-d H:i",intval($row['beginTime']));
	$row['createTime'] = date("Y-m-d H:i",$row['createTime']);
	$row['lastTime'] = date("Y-m-d H:i" ,$row['lastTime']);
	$sss = '';
	if ($row['orderState'] == 0) {
		$row['orderState'] = '未接单';
		$state = '已接单';
		// $sta = "../carDetail/readyOrder.php?a={$row['orderId']}";
		$sta = "../needOrder/needOrder.php?a={$row['orderId']}";
		if (isset($_SESSION['yes']) && $_SESSION['yes'] == 1) {
			$state = '';
		}
	} else if($row['orderState'] > 0) {
		if ($row['orderState'] == 1) {
			$row['orderState'] = '已接单';
			$color = "color:#8B0000;";
		$sta = "../carDetail/car2.php?a={$row['orderId']}";
		}else{
			$row['orderState'] = '已完成';
			$color = "color:red;";
			$sta = "../carDetail/car2.php?a={$row['orderId']}";
		}	
	}
		$sta = "<a href='{$sta}';>";
		if (!empty($row['driverId']) && ($row['driverId'] != $_SESSION['driverId'])) {
		$state = '';
		$sta = "<a href='#' onclick=war()>";
	}
		 // var_dump($row['driverId']);
		// print_r($_SESSION['driverId']);
		// echo "$number";die;
		// 如果司机有一个已接单没有完成的不能接单
		if ($number == 2) {
			$sta = "<a href='#' onclick=notice()>";
		}


		echo "<div class='line'>
				<span class='chepai' style='font-size:18px;font-weight:800;'>{$row['carLicense']}</span>
				<span class='time'>
					{$row['createTime']}	
				</span>
				<span class='statu ing' style='{$color}'>{$row['orderState']}</span><br>
				<span class='chepai' style='height:36px'>
					<i class='iconfont icon-ren-copy'></i>
				</span>
				<span class='chepai1'>商品：</span>
				<span class='chepai1'>{$row['goodName']}</span>
				<span class='chepai1' style='margin-left:50px;'>数量：</span>
				<span class='chepai1'>{$row['goodCount']}吨</span><br>	
				<span class='chepai' style='height:36px'>
					<i class='iconfont icon-ren-copy'></i>
				</span>
				<span class='chepai1'>出发时间：</span>						
				<span class='time'>
				{$row['beginTime']}	
				</span><br>
				<span class='chepai' style='height:36px'>
					<i class='iconfont icon-ren-copy'></i>
				</span>
				<span class='chepai1'>目的地：</span>	
				<span class='time'>
				{$row['destination']}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	{$sss}
				</span><br><br>
				<span class='chepai1'>订单号：</span>	
				<span class='time'>
				{$row['orderId']}
				</span>
				<span style='float:right;color:red;'>{$sta}></a><span>
				
			</div>";
	}
	if ($i >5) {
		echo "<center><b>没有更多了……</b></center>";
	} else{
		echo "<center><b>显示全部结果……</b></center>";
	}

}
?>
		
		</div>

		<div id="footer">
			<a href="./order.php" class="on">
				<img src="../images/paiduichaxun2.png" alt="">
				<p>公共订单池</p>
			</a>
			<a href="./myOrder.php">
				<img src="../images/yuyue.png" alt="">
				<p>个人订单</p>
			</a>
			<a href="../myself/myself.php">
				<img src="../images/gerenzhongxin.png" alt="">
				<p>个人中心</p>
			</a>
		</div>
	</div>
</div>
</body>
	<script type="text/javascript" src="../js/vue.min.js"></script>
	<script src="../js/jquery.min.weui.js"></script>
    <script src="../Home/js/jquery-weui.min.js"></script>
    <script>
    	function refresh(){
    		window.location.href="./order.php";
    	}
    	function notice(){
    		alert('请先完成当前已接订单');
    		window.location.href="./order.php";
    	}
    	function war(){
    		alert('不能点击其他人的订单');
    		window.location.href="./order.php";
    	}
    </script>

</html>