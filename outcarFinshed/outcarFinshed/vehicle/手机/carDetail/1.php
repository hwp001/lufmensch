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
			<p><i class="iconfont icon-zhengque1"></i>请填写合同号
			</p>
			<p class="bottom">请如实填写合同号，合同号由公司唯一提供</p>
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
			
<?php
$orderId = $_GET['a'];
?>
<form action="readyCheck.php?a='<?php echo $orderId;?>'" method="post">		
	 <div class="weui-cell no-access" >
        		<div class="weui-cell__hd " >
            		<label >提货单号 : <span style="position:relative;left:10px;"><?php echo "{$orderId}"; ?></span></label>
        		</div>
    		</div>
    		<div class="weui-cell no-access"  style="border: none;">
        		<div class="weui-cell__hd">
            		<label class="weui-label">请输入合同号：</label>
        		</div>
        		<div class="weui-cell__bd weui-cell__primary">
        			<input type="text" name="numId" placeholder="请根据提货单号填写合同号" style="border:none;">
        		</div>
    		</div>
		</div>
		<input type="submit" class="yes" value="确定">
</form>

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