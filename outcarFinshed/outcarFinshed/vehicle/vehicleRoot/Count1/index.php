<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../bootstrap/Css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="../bootstrap/Css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="../bootstrap/Css/style.css" />
    <script type="text/javascript" src="../bootstrap/Js/jquery.js"></script>
    <script type="text/javascript" src="../bootstrap/Js/jquery.sorted.js"></script>
    <script type="text/javascript" src="../bootstrap/Js/bootstrap.js"></script>
    <script type="text/javascript" src="../bootstrap/Js/ckform.js"></script>
    <script type="text/javascript" src="../bootstrap/Js/common.js"></script>
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
require("../Method/method.php");
require("../Method/rootCheck.php");
$root = new judRoot();
$r = $root->_judRootoot();
$add = 'disabled';
$order = '';
foreach ($r as $key => $value) {
    if ($key == 'add' || $key == 'allFunction') {
        $add = "";
    }
    if ($key != 'allObject') {
        if ($key == 'order') {
             $order = true;
        }
    }
}
if (!$order) {
    echo "<script>alert('你没有权限访问订单信息页面');location.go(-1);</script>";die;
}
?>

<form class="form-inline definewidth m20" action="index.php" method="get">    
    商品名称：
    <input type="text" name="key" id="username"class="abc input-default" placeholder="" value="">&nbsp;&nbsp;  
    <button type="submit" class="btn btn-primary">筛选</button>&nbsp;&nbsp; 
</form>

<form action="daochu.php" method="post">
        <div style="padding-left: 29px;">
            <button type="submit" class="btn btn-success" >导出</button>            
        </div>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>
        <th>选择</th>
        <th>商品编号</th>
        <th>商品名称</th>
        <th>商品销量(吨)</th>
    </tr>
    </thead>
<?php  
date_default_timezone_set('Asia/Shanghai');
$dim = new dimFound();  
$dim->_connect();
$key = @trim($_GET['key']);
$dim->_select($key,'vehicle_goods','Count1','goodSales');
// var_dump($dim->result);die;
// var_dump($row = $dim->result->fetch_assoc());die;
if (($row = $dim->result->fetch_assoc()) && mysqli_affected_rows($dim->mysqli)>0) {
    $str = "<tr><td><input type='checkbox' name='choose[]' value='{$row['goodId']}'></td>";
    foreach ($row as $k => $v) {
        if ($k == 'delState' || $k == 'goodTrueNum' || $k == 'goodNum' || $k == 'addTime' || $k == 'goodState') {
            continue;
        }
                      
        $str.="<td>{$v}</td>";
    }
        $id = $row['goodId'];
 

$str .="</tr>";

        echo "$str";
}
?>
   
</table>
</form>
</body>
</html>
<script>
    $(function () {     
        $('#addnew').click(function(){
                window.location.href="add.php";
         });
    });

</script>