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
if ($row['orderState'] == 1) {
    $checked = 'checked';
    $check = '';
} elseif ($row['orderState'] == 2) {
    $check = 'checked';
    $checked = '';
}
?>
<form action="addCheck.php?c=2" method="post">
    <b style="margin-left: 100px;">编辑订单状态</b>
<table class="table table-bordered table-hover definewidth m10">
    <tr>      
        <td  class="tableleft">订单编号：</td>
        <td><input style="width:120px;height: 23px;" type="text" name="orderId" value="<?php echo $row['orderId']; ?> " readonly/></td>
    </tr>       
    <tr>
        <td class="tableleft">状态操作：</td>
        <td>
            <input type="radio" name="orderState" value="1" <?php echo $checked;?> /> 进行中
            <input type="radio" name="orderState" value="2" <?php echo $check;?> /> 已结束
        </td>
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
