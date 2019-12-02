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
$node = false;
foreach ($r as $key => $value) {
    if ($key == 'add' || $key == 'allFunction') {
        $add = "";
    }
    if ($key != 'allObject') {
        if ($key == 'node') {
             $node = true;
        }
    }
}
if (!$node) {
    echo "<script>alert('你没有权限访问管理员管理页面');location.go(-1);</script>";die;
}
?>

<form class="form-inline definewidth m20" action="index.php?c=1" method="get">    
    管理员名称：
    <input type="text" name="key" id="username"class="abc input-default" placeholder="" $="">&nbsp;&nbsp;  
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp; 
    <button type="button" class="btn btn-success" id="addnew" <?php echo $add; ?>>新增管理员</button>
</form>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>
        <th>管理员名称</th>
        <th>管理员头像</th>
        <th>管理员角色</th>
        <th>登录次数</th>
        <th>上次登录IP</th>
        <th>上次登录时间</th>
        <th>真实姓名</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    </thead>
<?php  
@session_start();
date_default_timezone_set('Asia/Shanghai');
$dim = new dimFound();  
$dim->_connect();   
$key = @trim($_GET['key']);     
$dim->_select($key,'view_user','Node','userId');
while (($row = $dim->result->fetch_assoc()) && mysqli_affected_rows($dim->mysqli)>0) {

    $str = "<tr>";
    if ($row['delState'] == 0) {
        continue;
    }
    //检索出delState
    foreach ($row as $k => $v) {                
        if (($k == 'delState') || ($k == 'userId')) {
            continue;
        }
        if ($k == 'loginTime') {
            if ($v == 0) {
                $v == 0;
            } else {
                $v = date('Y.m.d H:i',$v);                
            }
        }
        if ($k == 'userImg') {
            $v = "<center><img src ='{$v}' style='width:40px;height:40px;'></center>";
        }
        if ($k == 'loginState') {
            if ($v == 1) {
                $v = '启用';
            } else {
                $v = '禁用';
            }
        }
        $str.="<td>{$v}</td>";
    }
        $id = $row['userId'];
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
    if ($id == 1) {
        $aa = '#';
        $dd = '#';
        $c1 = "color:red;";
        $c2 = "color:red;";
    }
$str.="<a href='{$aa}' style = '{$c1}'>编辑</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='{$dd}' style ='{$c2}'>删除</a></td></tr>";

$str .="</td></tr>";

        echo "$str";
}
?>
</table>



</body>
</html>
<script>
    $(function () {     
		$('#addnew').click(function(){
				window.location.href="add.php?c=1";
		 });
    });

	// function del(id)
	// {			
	// 	if(confirm("确定要删除吗？"))
	// 	{		
	// 		var url = "index.php";
			
	// 		window.location.href=url;				
	// 	}
	// }
</script>