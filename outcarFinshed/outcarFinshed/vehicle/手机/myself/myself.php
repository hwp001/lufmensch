<!DOCTYPE html>
<html lang="zh">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
 <title>个人中心</title>
 <script type="text/javascript" src="../js/js/flexible.js"></script>
 <link rel="stylesheet" type="text/css" href="../css/myCenter.css">
 <link rel="stylesheet" type="text/css" href="../css/jquery-weui.min.css">
    <link rel="stylesheet" type="text/css" href="../css/weui.min.css">
    <link rel="stylesheet" type="text/css" href="./myself.css">
</head>

<?php
session_start();
require('../Method/method.php');
if (isset($_GET['a'])) {
   $up = new upLOG();
    $up->_up('返回主页');
}
$myself = new mysqlCon();
$myself->_connect();
$driverPhone = !isset($_SESSION['driverPhone'])?"":$_SESSION['driverPhone'];
$where = "where driverBlock = 1 and driverPhone = {$driverPhone} and delState = 1;";
$res =  $myself->select('vehicle_drivers',$where);
$row = $res->fetch_assoc();
$str ="../../vehicleRoot/Driver/"."{$row['driverImg']}";
$driverName = $row['driverName'];
$driverId = $row['driverId'];

?> 
<body>
  <div class="head">
    <div class="headbody">个人中心 &nbsp;&nbsp;&nbsp;<a href="javascript:history.go(-1)"><span style="float: left;color: white;" > &nbsp;&nbsp;&nbsp;< </span></a></div>
  </div>
 <div id="main">
  <div class="driver">
   <div class="img"><img src="<?php echo $str?>"></div>
   <p><?php echo $driverPhone; ?></p >
<?php
@session_start();
$driverId = $_SESSION['driverId'];
$res->free();
$order = new order();
$order->_connect();
$res = $order->_orderCount('vehicle_order',$driverId);
$row = $res->fetch_assoc();
if (empty($row['orderT'])) {
  $row['orderT'] = 0;
}
if (empty($row['orderS'])) {
  $row['orderS'] = 0;
}

$orderT = $row['orderT'];//已完成
$orderS = $row['orderS'];//已接单未完成
$orderCount = $orderT + $orderS;//总分配订单
?>   
   <div class="order">
    <div class="order_left">
     <p><?php echo $orderCount;?></p >
     <p>已分配订单</p>
    </div>
    <div class="order_right">
     
      <p><?php echo $orderT;?></p>
     <p>已完成订单</p>
    </div>
   </div>
  </div>
  <div id="footer">
    <a href="../order/order.php" >
     <img src="../images/paiduichaxun.png" alt="">
     <p>公共订单池</p >
    </a>
    <a href="../order/myOrder.php">
     <img src="../images/yuyue.png" alt="">
     <p>个人订单</p >
    </a>
    <a href="#" class="on">
     <img src="../images/gerenzhongxin2.png" alt="">
     <p>个人中心</p >
    </a>
   </div>

 </div>
 <a href="../password/index.php"><div class="xiugai">&nbsp;&nbsp;&nbsp;修改个人密码<span style="float: right;"> >&nbsp;&nbsp;&nbsp; </span></div></a>
 <a href="../order/myOrder.php"><div class="xiugai" style="margin-top: 5px;">&nbsp;&nbsp;&nbsp;个人订单管理 <span style="float: right;"> >&nbsp;&nbsp;&nbsp; </span></div></a>
  <a href="./check.php?b=1"><div class="xiugai" style="margin-top: 5px;">
</body>
 <script type="text/javascript" src="../js/vue.min.js"></script>
 <script src="../js/jquery.min weui.js"></script>
 <script src="../js/jquery-weui.min.js"></script>
 <script>
 	function reback(){
 		window.history.back();
 	}
 </script>
</html>