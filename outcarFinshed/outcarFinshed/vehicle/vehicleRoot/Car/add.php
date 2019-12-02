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
<form action="addCheck.php?c=1" method="post">
<table class="table table-bordered table-hover definewidth m10">    
    <tr>
        <td  class="tableleft">&nbsp;&nbsp;&nbsp;车牌号：</td>
        <td><input type="text" name="carLicense" style="height: 20px;width: 140px;" placeholder="例如：粤A123456"  required /></td>
    </tr>   
    <tr>
        <td  class="tableleft">车辆编号：</td>
        <td><input type="text" name="carId" style="height: 20px;width: 140px;" required /></td>
    </tr>       
    <tr>
        <td class="tableleft">状态操作：</td>
        <td>
            <input type="radio" name="carState" value="1" checked/> 启用
            <input type="radio" name="carState" value="0"/> 禁用
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
