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
    司机编号：
    <input type="text" name="key" id="username"class="abc input-default" placeholder="" value="">&nbsp;&nbsp;  
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp;
    <b>效率参数：总接单数*30% + 已完成数*60% + 总载货量*10%</b>
</form>

<form action="daochu.php" method="post">
        <div style="padding-left: 29px;">
            <button type="submit" class="btn btn-success" >导出</button>            
        </div>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>
        <th>选择</th>
        <th>司机编号</th>
        <th>总接单量</th>
        <th>已完成量</th>
        <th>总载货量(吨)</th>
        <th>效率参数</th>
    </tr>
    </thead>
<?php  
date_default_timezone_set('Asia/Shanghai');
$dim = new dimFound();  
$dim->_connect();
$key = @trim($_GET['key']);
$dim->_select($key,'view_c3','Count2','efficiency');
// var_dump($dim->result);die;
// var_dump($row = $dim->result->fetch_assoc());die;
while (($row = $dim->result->fetch_assoc()) && mysqli_affected_rows($dim->mysqli)>0) {

     if ($row['delState'] == 0) {
        continue;
    }  
    $str = "<tr><td><input type='checkbox' name='choose[]' value='{$row['orderId']}'></td>";
    foreach ($row as $k => $v) {
        if ($k == 'delState' || $k == 'orderId') {
            continue;
        }
                      
        $str.="<td>{$v}</td>";
    }

        $id = $row['orderId'];

        $str .="</tr>";

        echo "$str";
}
?>
   
</table>
    <!-- 有多少条数据             当前第几页               总共多少页-->
<?php if($dim->count > 5) { ?>
<center>
<span>一共有<?php echo $dim->count; ?>条数据&nbsp;&nbsp;&nbsp;<?php echo $dim->page; ?>/<?php echo $dim->total; ?>页</span>
&nbsp;<a href="./index.php?page=1<?php echo $dim->wherelink; ?>" >首页</a>
&nbsp;<a href="./index.php?page=<?php echo ($dim->page-1)<1 ? 1 :($dim->page-1);echo $dim->wherelink; ?>">上一页</a>
&nbsp;<a href="./index.php?page=<?php echo ($dim->page+1)>$dim->total ? $dim->total : ($dim->page+1); echo $dim->wherelink; ?>">下一页</a>
&nbsp;<a href="./index.php?page=<?php echo $dim->total; echo $dim->wherelink;?>">尾页</a>
</center>

<?php }?>
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