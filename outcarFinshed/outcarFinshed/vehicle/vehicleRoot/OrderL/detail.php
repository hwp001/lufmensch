<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../Css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="../Css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="../Css/style.css" />
    <script type="text/javascript" src="../Js/jquery.js"></script>
    <script type="text/javascript" src="../Js/jquery.sorted.js"></script>
    <script type="text/javascript" src="../Js/bootstrap.js"></script>
    <script type="text/javascript" src="../Js/ckform.js"></script>
    <script type="text/javascript" src="../Js/common.js"></script>
    <style type="text/css">
        body {
            padding-bottom: 40px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }

        @media (max-width: 980px) {
            /* Enable use of floated navbar text */
            .navbar-text.pull-right {
                float: none;
                padding-left: 5px;
                padding-right: 5px;
            }
        }
    </style>
</head>
<?php
require('../Method/method.php'); 
$id = $_GET['a'];
$found = new addInfo();
$found->_connect();
$res = $found->_found($id,'order01');
$row = $res->fetch_assoc();
$row['beginTime'] = date('Y.m.d H:i',$row['beginTime']);
$row['lastTime'] = date('Y.m.d H:i',$row['lastTime']);
$row['createTime'] = date('Y.m.d H:i',$row['createTime']);
if ($row['driverId'] == 0) {
    $row['driverId'] = '暂无';
}
if ($row['goodTrueCount'] == 0) {
    $row['goodTrueCount'] = '暂无';
}
if ($row['existState'] == 1) {
    $checked = '上架';
} else {
    $checked = '下架';
}

?>

<form action="addCheck.php?c=1" method="post">
    <b style="margin-left: 100px;">订单详情</b>
<table class="table table-bordered table-hover definewidth m10">
    <tr>      
        <td  class="tableleft">订单编号：</td>
        <td><input style="width:120px;height: 23px;" type="text" name="orderId" value="<?php echo $row['orderId']; ?> " readonly/></td>
    </tr>       
    <tr>      
        <td  class="tableleft">&nbsp;&nbsp;&nbsp;订单号：</td>
        <td><input style="width:120px;height: 23px;" type="text" name="orderNum" value="<?php echo $row['orderNum']; ?> " readonly/></td>
    </tr> 
    <tr>      
        <td  class="tableleft">提货单号：</td>
        <td><input style="width:120px;height: 23px;" type="text" name="beginTime" value="<?php echo $row['orderTiNum']; ?>" readonly/></td>
    </tr>

    <tr>
        <td class="tableleft">&nbsp;&nbsp;&nbsp;车牌号：</td>
        <td><input style="width:120px;height: 23px;" type="text" name="beginTime" value="<?php echo $row['carLicense']; ?>" readonly/>
        </td>
    </tr>
    <tr>
        <td width="10%" class="tableleft">&nbsp;&nbsp;&nbsp;合同号：</td>
        <td><input type="text" name="destination" style="width:120px;height: 23px;" value="<?php echo $row['contract']; ?>" readonly/></td>
    </tr>    
    <tr>      
        <td  class="tableleft">出发时间：</td>
        <td><input style="width:120px;height: 23px;" type="text"  value="<?php echo $row['beginTime']; ?>" readonly/></td>
    </tr>
    <tr>      
        <td  class="tableleft">生成时间：</td>
        <td><input style="width:120px;height: 23px;" type="text" value="<?php echo $row['createTime']; ?>" readonly/></td>
    </tr>
    <tr>      
        <td  class="tableleft">到达时间：</td>
        <td><input style="width:120px;height: 23px;" type="text" value="<?php echo $row['lastTime']; ?>" readonly/></td>
    </tr>

    <tr>
        <td class="tableleft">司机编号：</td>
        <td><input style="width:120px;height: 23px;" type="text" value="<?php echo $row['driverId']; ?>" readonly/></td>        
    </tr>
    <tr>
        <td width="10%" class="tableleft">&nbsp;&nbsp;&nbsp;目的地：</td>
        <td><input type="text" name="destination" style="width:120px;height: 23px;" value="<?php echo $row['destination']; ?>" readonly/></td>
    </tr>
    <tr>
        <td class="tableleft">&nbsp;&nbsp;&nbsp;商 &nbsp;&nbsp; 品：</td>
        <td><input type="text" name="destination" style="width:120px;height: 23px;" value="<?php echo $row['goodName']; ?>" readonly/></td>
    <tr>  
        <td width="10%" class="tableleft">&nbsp;&nbsp;&nbsp;提货量(吨)：</td>
        <td><input type="text" name="goodCount" style="width:120px;height: 23px;"value="<?php echo $row['goodCount']; ?>" readonly/></td>
    </tr>        
    <tr>  
        <td width="10%" class="tableleft">实际货物量(吨)：</td>
        <td><input type="text" name="goodCount" style="width:120px;height: 23px;" value="<?php echo $row['goodTrueCount']; ?>" readonly/></td>
    </tr> 
<?php
if ($row['orderState'] == 0) {
    $stockout = '暂无';
} else {
    $stockout = $row['goodCount'] - $row['goodTrueCount'];
}
?>           
    <tr>  
        <td width="10%" class="tableleft">&nbsp;缺货信息:</td>
        <td><input type="text" name="goodCount" style="width:120px;height: 23px;"value="<?php echo $stockout; ?>" readonly/></td>
    </tr>    
    <tr>
        <td class="tableleft">&nbsp;&nbsp;&nbsp;状 &nbsp; 态：</td>
        <td>
        <input type="text" name="goodCount" style="width:120px;height: 23px;"value="<?php echo $checked; ?>" readonly/>
 
        </td>
    </tr>    
    <tr>
        <td class="tableleft"></td>
        <td>
            <a href="./index.php"><button type="button" class="btn btn-success" name="backid" id="backid">返回列表</button></a>
        </td>
    </tr>
</table>
</form>
</body>
</html>
