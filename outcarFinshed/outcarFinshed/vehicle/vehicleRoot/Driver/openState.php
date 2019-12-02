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
$res = $found->_found($id,'driver');
$row = $res->fetch_assoc();
if ($row['driverState'] == '1') {
    $checked = 'checked';
    $check = '';
} else {
    $check = 'checked';
    $checked = '';
}

// var_dump($row);

?>
<form action="openCheck.php" method="post" enctype="multipart/form-data">
<table class="table table-bordered table-hover definewidth m10">
    <b style="margin-left: 110px;">更改司机状态</b>
    <input type="hidden" name="driverId" value="<?php echo $row['driverId']?>">
    <tr>
        <td class="tableleft">状态操作：</td>
        <td>
            <input type="radio" name="driverState" value="1" <?php echo $checked;?>/> 启用
            <input type="radio" name="driverState" value="0" <?php echo $check;?> /> 禁用
        </td>
    </tr> 
<?php
if ($row['driverBlock'] == '1') {
    $checked = 'checked';
    $check = '';
} else {
    $checked = '';
    $check = 'checked';
}

?>

    <tr>
        <td class="tableleft">拉黑操作：</td>
        <td>
            <input type="radio" name="driverBlock" value="1" <?php echo $checked;?>/> 正常
            <input type="radio" name="driverBlock" value="0" <?php echo $check;?> /> 拉黑
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
