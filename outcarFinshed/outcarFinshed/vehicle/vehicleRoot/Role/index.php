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
$role = false;
foreach ($r as $key => $value) {
    if ($key == 'add' || $key == 'allFunction') {
        $add = "";
    }
    if ($key != 'allObject') {
        if ($key == 'role') {
             $role = true;
        }
    }

}
if (!$role) {
    echo "<script>alert('你没有权限访问角色信息页面');location.go(-1);</script>";die;
}
?>

<form class="form-inline definewidth m20" action="index.php" method="get">    
    角色名称：
    <input type="text" name="key" id="username"class="abc input-default" placeholder="" value="">&nbsp;&nbsp;  
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp; 
    <button type="button" class="btn btn-success" id="addnew" <?php echo $add; ?> >新增角色</button>
</form>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>
        <th>角色名称</th>
        <th>添加时间</th>
        <th>更新时间</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    </thead>
<?php  
date_default_timezone_set('Asia/Shanghai');
$dim = new dimFound();  
$dim->_connect();
$key = @trim($_GET['key']);
$dim->_select($key,'vehicle_role','Role','roleId');
while (($row = $dim->result->fetch_assoc()) && mysqli_affected_rows($dim->mysqli)>0) {
    $str = "<tr>";
    foreach ($row as $k => $v) {
        if (($k == 'rootName') || ($k == 'roleId') || ($k == 'delState')) {
            continue;
        }
        if ($k == 'roleState') {
            if ($v == '1') {
                $v = '可用';
            } else if($v == '0'){
                $v = '禁用';
             }                       
        }
        if ($k == 'addTime' || $k == 'updateTime') {
            $v = date('Y-m-d H:i',$v);
        }
        $str.="<td>{$v}</td>";
    }

    $id = $row['roleId'];

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
				window.location.href="add1.php";
		 });
    });

	function del(id)
	{			
		if(confirm("确定要删除吗？"))
		{		
			var url = "index.html";
			
			window.location.href=url;				
		}
	}
</script>