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
<form action="addCheck.php?c=1" method="post" enctype="multipart/form-data">
<table class="table table-bordered table-hover definewidth m10">
    <b style="margin-left: 120px;">管理员</b>
    <tr>
        <td width="10%" class="tableleft">头 &nbsp;&nbsp;&nbsp;&nbsp; 像：</td>
        <td><input type="file" name="userImg" accept="image/*" required/></td>
    </tr>
    <tr>     
        <td class="tableleft">角 &nbsp;&nbsp;&nbsp;&nbsp; 色：</td>
        <td>
    <select name='roleId' style="width: 149px;height: 25px">
<?php
require('../Method/method.php'); 
$found = new addInfo();
$found->_connect();
$where = "where roleState = 1 and delState = 1";
$res = $found->select('vehicle_role', $where);
while ($row = $res->fetch_assoc()) {
    if ($row['roleId'] == 1) {
        continue;
    }
    $str = "";
    $str .="<option value='{$row['roleId']}'>{$row['roleName']}</option>";
    echo $str;
}

?>
 </select>
        </td>
    </tr>               
    <tr>
        <td class="tableleft">真实姓名：</td>
        <td><input type="text" name="trueName" placeholder="请输入中文名" required/></td>
    </tr>  
    <tr>
        <td width="10%" class="tableleft">账号名称：</td>
        <td><input type="text" name="userName" placeholder="账号长度为2-10"  required /></td>
    </tr>
    <tr>
        <td class="tableleft">使用密码：</td>
        <td><input type="text" name="userPwd" placeholder="密码账号长度为5-16" required/></td>
    </tr>               
    <tr>
        <td class="tableleft">状态操作：</td>
        <td>
            <input type="radio" name="status" value="1" checked/> 启用
            <input type="radio" name="status" value="0"/> 禁用
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
