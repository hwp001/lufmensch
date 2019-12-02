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

?>
<form action="addCheck.php?c=2" method="post">
    <b style="margin-left: 100px;">编辑订单</b>
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
        <td class="tableleft">&nbsp;&nbsp;&nbsp;车牌号：</td>
        <td>
            <select name='carId' style="width:125px;height: 30px;">
<?php
$str = "<option value='{$row['carId']}'>{$row['carLicense']}</option>";
$where = "where carState = 1 and delState = 1";
$res = $found->select('vehicle_car', $where);
while ($row1 = $res->fetch_assoc()) {
    if ($row1['carId'] == $row['carId']) {
         continue;
}
$str .="<option value='{$row1['carId']}'>{$row1['carLicense']}</option>";
}
echo $str;
$res->free();
?>
            </select>
        </td>
    </tr>
    <tr>      
        <td  class="tableleft">出发时间：</td>
        <td><input style="width:120px;height: 23px;" type="date" name="beginTime" required /></td>
    </tr>
    <tr>      
        <td  class="tableleft">具体时分：</td>
        <td><input style="width:44.9px;height: 23px;" type="text" name="beginTime1[]" placeholder="00" required />&nbsp; :&nbsp; <input style="width:44.9px;height: 23px;" type="text" name="beginTime1[]" placeholder="00" required /></td>    
    </tr>    
    <tr>
        <td width="10%" class="tableleft">&nbsp;&nbsp;&nbsp;目的地：</td>
        <td><input type="text" name="destination" style="width:120px;height: 23px;" value="<?php echo $row['destination']; ?> " required/></td>
    </tr>
    <tr>
        <td class="tableleft">&nbsp;&nbsp;&nbsp;商 &nbsp;&nbsp; 品：</td>
        <td>
            <select name='goodId' style="width:125px;height: 30px;">
<?php
$str = "<option value='{$row['goodId']}'>{$row['goodName']}</option>";
$where = "where goodState = 1 and delState = 1";
$res = $found->select('vehicle_goods', $where);
while ($row1 = $res->fetch_assoc()) {
    if ($row1['goodId'] == $row['goodId']) {
         continue;
}
$str .="<option value='{$row1['goodId']}'>{$row1['goodName']}</option>";
}
echo $str;
$res->free();
?>
            </select>
        </td>
    <tr>  
        <td width="10%" class="tableleft">提货量(吨)：</td>
        <td><input type="text" name="goodCount" style="width:120px;height: 23px;" value="<?php echo $row['goodCount']; ?> "required/></td>
    </tr>         
    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary" type="button">保存</button>&nbsp;&nbsp;
            <a href="./index.php"><button type="button" class="btn btn-success" name="backid" id="backid">返回列表</button></a>
        </td>
    </tr>
</table>
</form>
</body>
</html>
