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
        .tableleft ul li{
            margin-left: 50px;
        }

    </style>
</head>
<body>
<form action="addCheck.php?c=1" method="post" class="definewidth m20">
    <table class="table table-bordered table-hover definewidth m10">
            <b style="margin-left: 110px;height: 30px;">角色</b> 
        <tr>
            <td style="width:100px" class="tableleft">角色名称:</td>
            <td><input type="text" name="roleName" placeholder="请输入中文字符" style="height: 30px;" /></td>
        </tr>
        
        <tr>
            <td class="tableleft">角色权限：</td>
            <td>
                <ul>
                    <li>
                        <input type='checkbox' name='group[]' value='allFunction' />操作功能</label>
                        <ul>
                             <li><input type='checkbox' name='node[]' value='read' checked disabled="true" />只读</label></li>
                            <li><input type='checkbox' name='node[]' value='add' />添加</label></li>
                            <li><input type='checkbox' name='node[]' value='edit' />编辑</label></li>
                            <li><input type='checkbox' name='node[]' value='delete' />删除</label></li>              
                        </ul>
                     </li>
                    <li>
                        <input type='checkbox' name='group[]' value='allObject' />操作对象</label>
                        <ul>
                            <li><input type='checkbox' name='node[]' value='log' />用户日志</label></li>
                            <li><input type='checkbox' name='node[]' value='node' />管理员管理</label></li>           
                            <li><input type='checkbox' name='node[]' value='role' />角色</label></li>
                            <li><input type='checkbox' name='node[]' value='good' />商品</label></li>
                            <li><input type='checkbox' name='node[]' value='driver' />司机</label></li>
                            <li><input type='checkbox' name='node[]' value='order' />订单</label></li>
                        </ul>
                     </li>
                    <tr><td class="tableleft">状态操作：</td>
                        <td>
                            <input type="radio" name="roleState" value="1" checked/> 启用
                            <input type="radio" name="roleState" value="0"/> 禁用
                        </td>
                    </tr>

                </ul> 
            </td>
        </tr>
        <tr>
            <td class="tableleft"></td>
            <td>
                <button type="submit" class="btn btn-primary" type="button">保存</button> &nbsp;&nbsp;<button type="button" class="btn btn-success" name="backid" id="backid">返回列表</button>
            </td>
        </tr>
    </table>
</form>
</body>
</html>
<script>
    $(function () {
        $(':checkbox[name="group[]"]').click(function () {
            $(':checkbox', $(this).closest('li')).prop('checked', this.checked);
        });

		$('#backid').click(function(){
				window.location.href="index.html";
		 });
    });
</script>