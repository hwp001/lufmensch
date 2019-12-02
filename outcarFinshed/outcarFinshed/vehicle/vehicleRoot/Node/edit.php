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
<body>
<?php 
// session_start();
// $edit = $_SESSION['edit'][0][0];
// echo "<pre>";
// print_r($edit);
require('../Method/method.php'); 
$id = $_GET['a'];
$found = new addInfo();
$found->_connect();
$res = $found->_found($id,'node');
$row = $res->fetch_assoc();
if ($row['loginState'] == '在线') {
    $checked = 'checked';
    $check = '';
} else {
    $check = 'checked';
    $checked = '';
}
 // var_dump($row);die;
?> 
<b  style="margin-left: 60px;">更改管理员信息</b>
<form action="addCheck.php?c=2" method="post">
<table class="table table-bordered table-hover definewidth m10">
   <input type="hidden" name="userId" value="<?php echo $row['userId'] ?>" />
    <tr>
        <td width="10%" class="tableleft">账号名称：</td>
        <td><input type="text" name="userName" value="<?php echo $row['userName'] ?>" /></td>
    </tr>
    <tr>
        <td class="tableleft">使用密码：</td>
        <td><input type="text" name="userPwd" placeholder="请填写密码" value="" /></td>
    </tr>   

    <tr>
        <td width="10%" class="tableleft">角色名称:</td>
        <td>
            <select name='roleId' style="width: 149px;height: 25px">
<?php
$str = "<option value='{$row['roleId']}'>{$row['roleName']}</option>";
$where = "where roleState = 1 and delState = 1";
$res = $found->select('vehicle_role', $where);
while ($row1 = $res->fetch_assoc()) {
    if ($row1['roleId'] == $row['roleId'] || $row1['roleName'] == '超级管理员') {
         continue;
}
$str .="<option value='{$row1['roleId']}'>{$row1['roleName']}</option>";
}
echo $str;
$res->free();
?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="tableleft">真实姓名：</td>
        <td><input type="text" name="trueName" value="<?php echo $row['trueName'] ?>"/></td>
    </tr>        
    <tr>
        <td class="tableleft">状态操作：</td>
        <td>
            <input type="radio" name="status" value="1" <?php echo $checked; ?>/> 启用
            <input type="radio" name="status" value="0" <?php echo $check; ?> /> 禁用
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
