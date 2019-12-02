<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<title>出车细节</title>
	<script type="text/javascript" src="../js/flexible.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/iconfont.css">
	<link rel="stylesheet" type="text/css" href="../css/myCenter.css">
	<link rel="stylesheet" type="text/css" href="../css/jquery-weui.min.css">
    <link rel="stylesheet" type="text/css" href="../css/weui.min.css">
    <link rel="stylesheet" type="text/css" href="./chuche.css">
	<link rel="stylesheet" type="text/css" href="./songda.css">
	<link rel="stylesheet" type="text/css" href="./iconfont.css">
	<style>
		.myIfo p{
			margin-left: 28px;
		}
	</style>
</head>
<body>
<div id="box" >
	<div id="main" >
		<div class="top">
			<p><i class="iconfont icon-zhengque1"></i>你已提货出车
			</p>
			<p class="bottom">到达目的地后请如实填写货物重量</p>
			<div class="userInfo">
			</div>
		</div>
		<div class="top">
			<div class="userInfo">
				<div class="userin">
					<i class="iconfont icon-jiedan"></i>
					<span>接单</span>
				</div>
				<h1></h1>
				<div class="userin">
					<i class="iconfont icon-xiaotuiruku"></i>
					<span>提货</span>
				</div>
				<h1></h1>
				<div class="userin">
					<i class="iconfont icon-daitihuo"></i>
					<span>送达</span>
				</div>
			</div>
	<form action="carCheck.php" method="post">				
<?php
require('../Method/method.php');
session_start();
$_SESSION['yes'] = 1;
//判断用户是否登录
if (!isset($_SESSION['driverName']) ||  !isset($_GET['a']) ) {
	echo "<script>alert('未登录');location.href='../login/index.php';</script>";
}
$orderId = $_GET['a'];
$carFound = new mysqlCon();
$carFound->_connect();
$table = "vehicle_order as a,vehicle_car as b,vehicle_goods as c";
$where = "where orderId = {$orderId} and a.goodId = c.goodId and b.carId = a.carId and a.delState = 1";
$res = $carFound->select($table,$where);
$row = $res->fetch_assoc();
$beginTime = date('Y.m.d H:i',intval($row['beginTime']));
$row['createTime'] = date('Y.m.d H:i',$row['createTime']);
	 echo "<div class='weui-cell no-access' >
        		<div class='weui-cell__hd '>
            		<label class='weui-label' >提货量(吨) : <span style='position:relative;left:26px;'>{$row['goodCount']}</span></label>
        		</div>
    		</div>
    		<div class='weui-cell no-access'  style='border: none;'>
        		<div class='weui-cell__hd'>
            		<label class='weui-label'>{$row['goodName']}</label>
        		</div>
        		<div class='weui-cell__bd weui-cell__primary'>
        			<input type='text' name='goodTrueCount' placeholder='请如实填入实际货物量' style='border:none;'>
        		</div>
    		</div>
		</div>
		<input type='hidden' name ='beginTime' value='{$row['beginTime']}'>
		<input type= 'hidden' name='orderId' value='{$row['orderId']}'>
		<input type='submit' class='yes' value='确定'>
</form>
		<div class='myIfo' style='height:400px;'>
			<div class='line'>
				<div class='line-left'>
					<span><i class='iconfont icon-Home_icon_chepaiquer-copy'></i>&nbsp;&nbsp;车牌号</span>
					<p>{$row['carLicense']}</p>
				</div>
				<div class='line-right'>
					<span><i class='iconfont icon-dingdan'></i>&nbsp;&nbsp;订单状态</span>
					<p>已接单</p>
				</div>
			</div>
			<div class='line'>
				<div class='line-left'>
					<span><i class='iconfont icon-goods-copy'></i>&nbsp;&nbsp;商品</span>
					<p>{$row['goodName']}</p>
				</div>
				<div class='line-right'>
					<span><i class='iconfont icon-shuliang-zengjia'></i>&nbsp;&nbsp;数量</span>
					<p>{$row['goodCount']}</p>
				</div>
			</div>
			<div class='line'>
				<div class='line-left'>
					<span><i class='iconfont icon-naozhong'></i>&nbsp;&nbsp;出发时间</span>
					<p>{$beginTime}</p>
				</div>
			</div>	
			<div class='line'>
				<div class='line-left'>
					<span><i class='iconfont icon-position'></i>&nbsp;&nbsp;目的地</span>
					<p>{$row['destination']}</p>
				</div>
			</div>	
			<div class='line'>
				<div class='line-left'>
					<span><i class='iconfont icon-dingdan1'></i>&nbsp;&nbsp;合同号</span>
					<p>{$row['contract']}</p>
				</div>
				<div class='line-right'>
					<span><i class='iconfont icon-hetong8'></i>&nbsp;&nbsp;提货单号</span>
					<p>{$row['orderId']}</p>
				</div>
			</div>
		</div>
	</div>"?>

	  <div id="footer">
	    <a href="../order/order.php" >
	     <img src="../images/paiduichaxun.png" alt="">
	     <p>公共订单池</p >
	    </a>
	    <a href="../order/myOrder.php">
	     <img src="../images/yuyue.png" alt="">
	     <p>个人订单</p >
	    </a>
	    <a href="./myself">
	     <img src="../images/gerenzhongxin.png" alt="">
	     <p>个人中心</p >
	    </a>
	   </div>

	
</div>
		
</body>
	<script type="text/javascript" src="../js/vue.min.js"></script>
	<script src="../js/jquery.min weui.js"></script>
    <script src="../js/jquery-weui.min.js"></script>

</html>