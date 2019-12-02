<!Doctype html>
<html>
<head>
<meta charset="utf-8">
<title>login</title>
<style type="text/css">
*{
    margin: 0;
    padding: 0;
}
#wrap {
    height: 850px;
    width: 100%;
    background-image: url('./login/background.jpg');
    background-repeat: no-repeat;
    background-position: center;
    position: relative;

}
#head {
    height: 130px;
    width: 100;
    background-color: #66CCCC;
    text-align: center;
    position: relative;
}

#wrap .logGet {
    height: 403px;
    width: 418px;    
    background-color: #FFFFFF;
    margin:0 auto;
    position: relative;
    left:32px;
    top: 10%;

}
.logC input{
    width: 100%;
    height: 45px;
    background-color: #ee7700;
    border: none;
    color: white;
    font-size: 18px;
}
.logC input:hover{
    cursor: pointer;/*手型光标*/
}

.logGet .logD.logDtip .p1 {
    display: inline-block;
    font-size: 28px;
    margin-top: 30px;
    width: 86%;
}
#wrap .logGet .logD.logDtip {
    width: 86%;
    border-bottom: 1px solid #ee7700;
    margin-bottom: 60px;
    margin-top: 0px;
    margin-right: auto;
    margin-left: auto;
}
.logGet .lgD img {
    position: absolute;
    top: 12px;
    left: 8px;
}
.logGet .lgD input {
    width: 100%;
    height: 45px;
    text-indent: 2.5rem;
}
#wrap .logGet .lgD {
    width: 86%;
    position: relative;
    margin-bottom: 30px;
    margin-top: 30px;
    margin-right: auto;
    margin-left: auto;
}
#wrap .logGet .logC {
    width: 86%;
    margin-top: 0px;
    margin-right: auto;
    margin-bottom: 0px;
    margin-left: auto;
}
 
 
.title {
    font-family: "宋体";
    color: #FFFFFF;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);  /* 使用css3的transform来实现 */
    font-size: 36px;
    height: 40px;
    width: 30%;
}
</style>
</head>
<body>
<div class="header" id="head">
    <div class="title">预约装车管理系统</div>    
</div>  
<div class="wrap" id="wrap">
    <div class="logGet">
            <!-- 头部提示信息 -->
            <div class="logD logDtip">
                <p class="p1">登录</p>
            </div>
            <!-- 输入框 -->
            <form action="./loginCheck.php" method="post">
            <div class="lgD">
                <img src="./login/02.png" width="20" height="20" alt=""/>
                <input type="text" name="userName"
                    placeholder="输入用户名" />
            </div>
            <div class="lgD">
                <img src="./login/Group-.png" width="20" height="20" alt=""/>
                <input type="password" name="userPwd"
                    placeholder="输入用户密码" />
            </div>
            <div class="logC">
                <input type="submit" value="登录">
            </div>
            </form>
        </div>
</div>       
</body>
</html>