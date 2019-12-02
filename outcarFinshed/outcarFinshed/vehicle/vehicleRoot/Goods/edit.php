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
<body>
<?php 
// session_start();
// $edit = $_SESSION['edit'][0][0];
// echo "<pre>";
// print_r($edit);
require('../Method/method.php'); 
$id = $_GET['a'];
$found = new addInfo();
$found->_connect();
$res = $found->_found($id,'good');
$row = $res->fetch_assoc();

 // var_dump($row);die;
?> 
<b  style="margin-left: 60px;">更改商品信息</b>
<form action="addCheck.php?c=2" method="post">
<table class="table table-bordered table-hover definewidth m10">
    <input type="hidden" name="goodSales" value="<?php echo $row['goodSales']?>" >
<?php
        
 echo "<tr>
            <td width='10%' class='tableleft'>商品编号：</td>
            <td><input type='text' name='goodId' value='{$row['goodId']}' readonly/></td>
        </tr>
        <tr>
            <td class='tableleft'>商品名称：</td>
            <td><input type='text' name='goodName'  value='{$row['goodName']}' /></td>
        </tr>   
        <tr>
            <td class='tableleft'>商品数量：</td>
            <td><input type='text' name='goodNum' value='{$row['goodNum']}'/></td>
        </tr>        
        <tr>
            <td class='tableleft'>实际数量:</td>
            <td><input type='text' name='goodTrueNum' value='{$row['goodTrueNum']}'/></td>
        </tr>               
        <tr>
            <td class='tableleft'></td>
            <td>
                <button type='submit' class='btn btn-primary' type='button'>保存</button>&nbsp;&nbsp;
                <a href='./index.php'><button type='button' class='btn btn-success' name='backid' id='backid'>返回列表</button></a>           
            </td>
        </tr>"
?>    
</table>
</form>
</body>
</html>
