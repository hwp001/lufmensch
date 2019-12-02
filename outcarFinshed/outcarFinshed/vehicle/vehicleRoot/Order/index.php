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
    订单信息：
    <input type="text" name="key" id="username"class="abc input-default" placeholder="" value="">&nbsp;&nbsp;  
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp; 
    <button type="button" class="btn btn-success" id="addnew" <?php echo $add; ?> >新增订单</button>
</form>
<form action="daochu.php" method="post">
        <div style="padding-left: 29px;">
            <button type="submit" class="btn btn-success" >导出</button>            
        </div>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>
        <th>选择</th>
        <th>订单编号</th>
        <th>订单号</th>
        <th>提货单号</th>
        <th>合同号</th>
        <th>车牌号</th>
        <th>订单生成时间</th>
        <th>出发时间</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    </thead>
<?php  
date_default_timezone_set('Asia/Shanghai');
$dim = new dimFound();  
$dim->_connect();
$key = @trim($_GET['key']);
$dim->_select($key,'view_order','Order','createTime');
// var_dump($dim->result);die;
// var_dump($row = $dim->result->fetch_assoc());die;
while (($row = $dim->result->fetch_assoc()) && mysqli_affected_rows($dim->mysqli)>0) {

     if ($row['delState'] == 0) {
        continue;
    }  
    $str = "<tr><td><input type='checkbox' name='choose[]' value='{$row['orderId']}'></td>";
    foreach ($row as $k => $v) {
        if ($k == 'delState' || $k == 'goodTrueCount' || $k == 'goodCount') {
            continue;
        }
        if ($k == 'orderState') {
            if ($v == '0') {
                $v = '未接单';
            } else if ($v == '1'){
                $v = '已接单';
             } else if ($v == '2'){
                $v = '订单完成';
             }           
        }
        if ($k == 'createTime' || $k == 'beginTime') {
            $v = @date('Y.m.d H:i',$v);
        }                        
        $str.="<td>{$v}</td>";
    }
        $id = $row['orderId'];
 
// 权限判断
$str .="<td>";
$aa = '#';
$dd = '#';
$c1 = "color:red;";
$c2 = "color:red;";
foreach ($r as $key => $value) {
    if ($key == 'allFunction') {
            $aa = "edit.php?a={$id}";
            $dd = "editDel.php?a=Car&b={$id}";
            $c1 = '';$c2 = '';
    } else {
        if ($key == 'edit') {
            $aa = "edit.php?a={$id}";
            $c1 = '';
        } 
        if ($key == 'delete') {
             $dd = "editDel.php?a=Car&b={$id}";
             $c2 = '';
        }
    }
}
$str.="<a href='{$aa}' style = '{$c1}'>编辑</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='{$dd}' style ='{$c2}'>删除</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='./detail.php?a={$id}' style ='{$c2}'>详情</a></td></tr>";

$str .="</td></tr>";

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