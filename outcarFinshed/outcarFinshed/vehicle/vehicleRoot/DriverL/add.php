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
    <b style="margin-left: 110px;">司机</b>  
    <tr>
        <td width="10%" class="tableleft">&nbsp;&nbsp;&nbsp;手机号：</td>
        <td><input type="text" name="driverPhone" placeholder="请输入手机号" required/></td>
    </tr>
        <tr>
        <td width="10%" class="tableleft">&nbsp;&nbsp;&nbsp;密 &nbsp; 码：</td>
        <td><input type="text" name="driverPwd" placeholder="请输入密码" required/></td>
    </tr>
    <tr>    
        <td width="10%" class="tableleft" >&nbsp;&nbsp;&nbsp;姓 &nbsp; 名：</td>
        <td><input type="text" name="driverName" placeholder="请输入真实姓名" required/></td>
    </tr>  
    <tr>
        <td width="10%" class="tableleft">&nbsp;&nbsp;&nbsp;头 &nbsp; 像：</td>
        <td><input type="file" name="driverImg" accept="image/*" required/></td>
    </tr> 

    <!-- <tr>
        <td width="10%" class="tableleft">注册时间：</td>
        <td><input type="text" name="applyDate"/></td>
    </tr>       -->
    <tr>
        <td class="tableleft">状态操作：</td>
        <td>
            <input type="radio" name="driverState" value="1" checked/> 启用
            <input type="radio" name="driverState" value="0"/> 禁用
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
