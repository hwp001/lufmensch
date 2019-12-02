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
$add = '';
$logs = false;
foreach ($r as $key => $value) {
    if ($key != 'allObject') {
        if ($key == 'logs') {
             $logs = true;
        }
    }
}
if (!$logs) {
    echo "<script>alert('你没有权限访问管理员信息页面');location.go(-1);</script>";die;
}
?>
    
<form class="form-inline definewidth m20" action="index.php" method="get">    
    用户账户名称：
    <input type="text" name="key" id="username"class="abc input-default" placeholder="" value="">&nbsp;&nbsp;  
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp; 
</form>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>
        <th>用户账号</th>
        <th>用户角色</th>
        <th>操作描述</th>
        <th>地址</th>
        <th>操作时间</th>
        <th>状态</th>
        <th>Ip地址</th>
        <th>操作</th>
    </tr>
    </thead>
<?php  
date_default_timezone_set('Asia/Shanghai');
$dim = new dimFound();  
$dim->_connect();
$key = @trim($_GET['key']);
$dim->_select($key,'vehicle_log','Log','ActivityTime');
while (($row = $dim->result->fetch_assoc()) && mysqli_affected_rows($dim->mysqli)>0) {
    $str = "<tr>";

    foreach ($row as $k => $v) {
        if ($k == 'logid' || $k == 'delState') {
            continue;
        }
        if ($k == 'ActivityState') {
            if ($v == 1) {
                $v = '操作成功';
            } else {
                $v = '操作失败';
            }
        }
        if ($k == 'ActivityTime') {
            $v = date('Y.m.d H:i:s',$v);
        }
        $str.="<td>{$v}</td>";
    }
    $b = $row['logid'];
    $str.="<td><a href='./editDel.php?b={$b}' >删除</a></td></tr>";
    echo "$str"; 
}

?>    
</table>
    <!-- 有多少条数据             当前第几页               总共多少页-->
<center>
<span>一共有<?php echo $dim->count; ?>条数据&nbsp;&nbsp;&nbsp;<?php echo $dim->page; ?>/<?php echo $dim->total; ?>页</span>
&nbsp;<a href="./index.php?page=1<?php echo $dim->wherelink; ?>" >首页</a>
&nbsp;<a href="./index.php?page=<?php echo ($dim->page-1)<1 ? 1 :($dim->page-1);echo $dim->wherelink; ?>">上一页</a>
&nbsp;<a href="./index.php?page=<?php echo ($dim->page+1)>$dim->total ? $dim->total : ($dim->page+1); echo $dim->wherelink; ?>">下一页</a>
&nbsp;<a href="./index.php?page=<?php echo $dim->total; echo $dim->wherelink;?>">尾页</a>
</center>


</body>
</html>
<script>
    $(function () {     
        $('#addnew').click(function(){
                window.location.href="add.html";
         });
    });

</script>