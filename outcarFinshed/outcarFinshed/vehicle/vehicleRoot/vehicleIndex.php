
<!DOCTYPE HTML>
<html>
<head>
    <title>后台管理系统</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/bui-min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/main-min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php @session_start();
require('./Method/method.php');

?>

<div class="header">    
    <div class="dl-title">
        <!--<img src="/chinapost/Public/assets/img/top.png">-->
    </div>

    <div class="dl-log">欢迎您，<span class="dl-log-user" style="position:relative;"><?php echo @$_SESSION['username'];?></span><a href="Public/index.php" title="退出系统" class="dl-log-quit">[退出]</a>
    </div>
</div>
<div class="content">
    <div class="dl-main-nav">
        <div class="dl-inform"><div class="dl-inform-title"><s class="dl-inform-icon dl-up"></s></div></div>
        <ul id="J_Nav"  class="nav-list ks-clear">
            <li class="nav-item dl-selected"><div class="nav-item-inner nav-home">后台管理</div></li>
        </ul>
    </div>
    <ul id="J_NavContent" class="dl-tab-conten">
    </ul>
</div>
<script type="text/javascript" src="assets/js/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="assets/js/bui-min.js"></script>
<script type="text/javascript" src="assets/js/common/main-min.js"></script>
<script type="text/javascript" src="assets/js/config-min.js"></script>
<script>
    BUI.use('common/main',function(){
        var config = [{id:'1',menu:[
        {text:'日志管理',items:[
        {id:'12',text:'用户日志',href:'Log/index.php'}
       	]},
        {text:'系统管理',items:[
        {id:'21',text:'管理员管理',href:'Node/index.php'},
        {id:'22',text:'角色管理',href:'Role/index.php'}  
        ]},
        {text:'订单管理',items:[
        {id:'3',text:'订单信息',href:'Order/index.php'},
        {id:'31',text:'订单列表',href:'OrderL/index.php'}
        ]
    },
        {text:'车辆管理',items:[
        {id:'4',text:'车辆信息',href:'Car/index.php'}
        ]},
        {text:'统计分析',items:[
        {id:'51',text:'统计订单状态',href:'Count/index.php'},
        {id:'52',text:'统计司机效率',href:'Count2/index.php'},
        {id:'53',text:'统计商品状态',href:'Count1/index.php'}
        ]},
        {text:'用户管理',items:[
        {id:'6',text:'司机列表',href:'Driver/index.php'}
        ]},
        {text:'杂项管理',items:[
        {id:'71',text:'商品信息',href:'Goods/index.php'}
        ]}]
    }];

        new PageUtil.MainPage({
            modulesConfig : config
        });
    });
</script>
<div style="text-align:center;">
<p>欢迎您：<a href="http://www.php.cn/" target="_blank">黄炜鹏大佬</a></p>
</div>
</body>
</html>