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
$res = $found->_found($id,'Driver');
$row = $res->fetch_assoc();

// var_dump($row);

?>
<form action="addCheck.php?c=1" method="post" enctype="multipart/form-data">
<table class="table table-bordered table-hover definewidth m10">
    <b style="margin-left: 110px;">司机详情页</b>  
    <tr>
        <td class="tableleft">&nbsp;&nbsp;&nbsp;头 &nbsp; 像：</td>
        <td><img src="<?php echo $row['driverImg'];?>" style="width: 100px;height: 100px;"></td>
    </tr>
    <tr>    
        <td width="10%" class="tableleft" >&nbsp;&nbsp;&nbsp;姓 &nbsp; 名：</td>
        <td><input type="text" name="driverName" value="<?php echo $row['driverName']?>" readonly/></td>
    </tr>
    <tr>
        <td width="10%" class="tableleft">&nbsp;&nbsp;&nbsp;手机号：</td>
        <td><input type="text" name="driverPhone" value="<?php echo $row['driverPhone']?>" readonly/></td>
    </tr>
        <tr>
        <td width="10%" class="tableleft">&nbsp;&nbsp;&nbsp;密 &nbsp; 码：</td>
        <td><input type="text" name="driverPwd" value="<?php echo $row['driverPwd']?>" readonly/></td>
    </tr>  
 
<?php
if ($row['driverBlock'] == 1) {
    $check = '拉黑';
} else {
    $check = '正常';    
}
?>        
    <tr>
        <td width="10%" class="tableleft">&nbsp;&nbsp;&nbsp;黑名单：</td>
        <td><input type="text" name="" value="<?php echo $check?>" readonly/></td>
    </tr> 
<?php
if ($row['driverState'] == 1) {
    $checked = '启用';
} else {
    $checked = '禁用';    
}
?>
    <tr>
        <td width="10%" class="tableleft">&nbsp;&nbsp;&nbsp;状&nbsp;&nbsp; 态：</td>
        <td><input type="text" name="" value="<?php echo $checked?>" readonly/></td>
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
