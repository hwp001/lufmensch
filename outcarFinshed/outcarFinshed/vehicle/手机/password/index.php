<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="UTF-8">
  <title>修改个人密码</title>
  <link rel="stylesheet" type="text/css" href="css.css">
  <script src="jquery.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
<?php 
session_start();
$driverPhone = $_SESSION['driverPhone']; 
?>
  <div class="header">
    <a href="../myself/myself.php" ><span id="header_left"><</span></a>
    <span id="header_right">修改个人密码</span>
  </div>
  <div class="content">
     <form action="./updateCheck.php" method="post">
        <div class="form_div">
          <span class="form_div_span">账号</span>
          <span class="form_div_span1"><?php echo $driverPhone?></span>
        </div>
        <div class="form_div">
          <span class="form_div_span">原密码</span>
          <input type="text" name="driverPwd"  placeholder="请输入原始密码">
        </div>
        <div class="form_div">
          <span class="form_div_span">新密码</span>
          <input type="text" name="newpass1"  placeholder="请输入新密码" class="passinput" maxlength="18">
        </div>
        <div class="form_div">
          <span class="form_div_span">重新输入密码</span>
          <input type="text" name="newpass2" value="" placeholder="请输入新密码" class="passinput" maxlength="18">
        </div>
        <button class="form_button" type="submit" onMouseUp="this.style.backgroundColor='#EE7600'" onMouseDown="this.style.backgroundColor='#EE7643'">确认</button>
     </form>
  </div>
 <script type="text/javascript">
$(document).ready(function(){
   $(".passinput").keyup(function(){
     if ($(".passinput").val().length >=18){
     alert('最多只能输入18个字符')///这里你换成其他更友善的提示调用函数什么的都行
    } 
 });
});
</script>
</body>
</html>


<!-- <div class="form-group">
          <div class="label">
            <label for="sitename">原始密码：</label>
          </div>
          <div class="field">
            <input type="password" class="input w50" id="mpass" name="mpass" size="50" placeholder="请输入原始密码" data-validate="required:请输入原始密码" />       
          </div>
      </div>  -->