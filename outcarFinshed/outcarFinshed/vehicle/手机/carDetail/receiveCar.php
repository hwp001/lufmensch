<?php?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<title>出厂细节</title>
	<script type="text/javascript" src="../js/flexible.js"></script>
	<link rel="stylesheet" type="text/css" href="./iconfont.css">
	<link rel="stylesheet" type="text/css" href="../css/myCenter.css">
	<link rel="stylesheet" type="text/css" href="../css/jquery-weui.min.css">
    <link rel="stylesheet" type="text/css" href="../css/weui.min.css">
    <link rel="stylesheet" type="text/css" href="./chuche.css">

</head>
<body>
<?php
require('../Method/method.php');
$receive = new mysqlCon();
$receive->_connect();
$orderId = $_GET['a'];
$where=" where orderId='{$orderId}' and delState = 1 and existState = 1";
$res = $receive->select('view_ordert',$where);
$row = $res->fetch_assoc();
$row['beginTime'] = date('Y.m.d H:i',$row['beginTime']);
$row['createTime'] = date('Y.m.d H:i',$row['createTime']);
?>

<div id="box" style="height:20rem">
	<div id="main">
		<div class="top">
			<p><i class="iconfont icon-zhengque1"></i>你已接单
			</p>
			<p class="bottom">请前往出发提货</p>
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
				<div class="userin" style="color:grey">
					<i class="iconfont icon-xiaotuiruku"></i>
					<span>提货</span>
				</div>
				<h1></h1>
				<div class="userin" style="color:grey">
					<i class="iconfont icon-daitihuo"></i>
					<span>送达</span>
				</div>
			</div>
			<div class="weui-cell no-access" >
        		<div class="weui-cell__hd ">
            		<label class="weui-label" >提货单号:</label>
        		</div>
    		</div>
    		<form action="./receiveCheck.php?a=<?php echo $orderId;?>" method="post" id="pickgoods">
	    		<div class="weui-cell no-access"  style="border: none;">
	        		<div class="weui-cell__bd weui-cell__primary">
	        			<input type="text" name="orderTiNum" placeholder="请填入提货单号" style="border:none;">
	        		</div>
	    		</div>
	    	</form>
		</div>
    	<button class="yes" onclick="document.getElementById('pickgoods').submit()">确定</button>

		<div class="myIfo">
			<div class="line">
				<div class="line-left">
					<span><i class="iconfont icon-Home_icon_chepaiquer-copy"></i>&nbsp;&nbsp;车牌号</span>
					<p><?php echo $row['carLicense']?></p>
				</div>
				<div class="line-left">
					<span><i class="iconfont icon-dingdan"></i>&nbsp;&nbsp;订单状态</span>
					<p>待提货</p>
				</div>
				<div class="line-right">
					<span><i class="iconfont icon-dingdan"></i>&nbsp;&nbsp;订单编号</span>
					<p><?php echo $row['orderId']?></p>
				</div>
			</div>
			<div class="line">
				<div class="line-left">
					<span><i class="iconfont icon-goods-copy"></i>&nbsp;&nbsp;商品</span>
					<p><?php echo $row['goodName']?></p>
				</div>
				<div class="line-right">
					<span><i class="iconfont icon-shuliang-zengjia"></i>&nbsp;&nbsp;数量</span>
					<p><?php echo $row['goodCount']?>吨</p>
				</div>
			</div>
			<div class="line">
				<div class="line-left">
					<span><i class="iconfont icon-naozhong"></i>&nbsp;&nbsp;出发时间</span>
					<p><?php echo $row['beginTime']?></p>

				</div>
				<div class="line-right">
					<span><i class="iconfont icon-naozhong"></i>&nbsp;&nbsp;订单创建时间</span>
					<p><?php echo $row['createTime']?></p>

				</div>
			</div>	
			<div class="line">
				<div class="line-left">
					<span><i class="iconfont icon-position"></i>&nbsp;&nbsp;目的地</span>
					<p><?php echo $row['destination']?></p>
				</div>
			</div>	
			<div class="line">
				<div class="line-left">
					<span><i class="iconfont icon-dingdan1"></i>&nbsp;&nbsp;合同号</span>
					<p><?php echo $row['contract']?></p>
				</div>
			</div>
		</div>
	</div>
</div>
		<div id="footer">
				<a href="../order/order.php" >
					<img src="../images/paiduichaxun.png" alt="">
					<p>公共订单池</p>
				</a>
				<a href="../order/myOrder.php" style="color:orange">
					<img src="../images/yuyue2.png" alt="">
					<p>个人订单</p>
				</a>
				<a href="../driver/driver.php" class="on" style="color:black">
					<img src="../images/gerenzhongxin.png" alt="">
					<p>个人中心</p>
				</a>
		</div>


		</div>
	
</body>
	<script type="text/javascript" src="../js/vue.min.js"></script>
	<script src="../js/jquery.min weui.js"></script>
    <script src="../js/jquery-weui.min.js"></script>

</html>