<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>预约出车</title>
	<script type="text/javascript" src="./flexible.js"></script>
	
</head>
<style>
.weui-mask.weui-mask--visible{
	opacity: 0.2;
}
*{
	margin:0;
	padding: 0;
	font-family:"MIcrosoft YaHei" ;
    
}
body{
	position: relative;
	background: url(./bg.png)no-repeat;
	background-size: 100%;	
	height: 100%;
}
ul,li{
	list-style-type: none;
}
a{
	text-decoration:none;outline:none;
   -moz-outline-style:none;
}
input{

	outline:none;
}
#main{
	padding-top: 1rem;
}
.controll{
	width: 95%;
	margin: 0 auto;
	margin-bottom: .35rem;
	background-color: #fff;
	box-shadow: 5px 5px 5px #ccc7c7;
	font-size: .4rem;
	color: #333;
	border-radius: -10rem;
}
.line{
	overflow: hidden;
	border-bottom: 1px solid #e5e5e5;
	height: 1.2rem;
    line-height: 1.2rem;
    width: 95%;
    margin: 0 auto;
    position: relative;
}
.controll .weui-cell__bd:after{
	border-color: #999999;
}
.line .a1{
	width: 1rem;
	height: 1.2rem;
	float: left;
}
.a1 .yuan{
	background-color: rgb(235,129,36);
	border-radius: 50%;
	float: left;
	width: .5rem;
    height: .5rem;
    margin-top: .35rem;
}
.line .Txt{
	width: 2.0rem;
	float: left;
}
.line input{
	width: 5rem;
	float: left;
	height: 1.2rem;
    line-height: 1.2rem;
}
.subBtn{
	width: 60%;
	margin: 0 auto;
	background-color: #EB8124;
	color: #fff;
	text-align: center;
	font-size: .4rem;
	border-radius: .6rem;
	height: 1.2rem;
	line-height: 1.2rem;
}
.subBtn input:hover{
	cursor:pointer;
}

.weui-input{
	border: 0px;
	height: 150px;
}
</style>
<?php
session_start();
$phone = (!isset($_SESSION['lin']))?"":$_SESSION['lin'];
?>
<body>
	<form action="./loginCheck.php" method="post">
		<div id="main" style="margin-top: 200px;">
			<div class="controll">
				<div class="line">
					<div class="a1">
					</div>			
					<span class="Txt">手机号</span>				
					<input type="tel" class="weui-input" placeholder="请输入您的手机号" name="driverPhone" value="<?php echo $phone;?>">	
				</div>
				<div class="line">
					<div class="a1">
					</div>
					<span class="Txt">密码</span>	
					<input type="password" class="weui-input" placeholder="请输入您的密码" name="driverPwd">
				</div>

			</div>
			
	
		<div class="subBtn" onclick="skip()" style="border-radius: .2rem;width: 95%;">
			<input type="submit" value="登录" style="width: 80%;height: 80%;background: #EB8124;border: 0;"></div>
		</div>	
	</form>
</body>
</html>

<script>
	function skip(){
		window.location.href="loginCheck.php";
	}
</script>