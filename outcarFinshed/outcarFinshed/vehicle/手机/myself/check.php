<?php
	session_start();
$b = (empty($_GET['b']))?"":$_GET['b'];
if ($b == 1) {
	session_destroy();
	echo "<script>alert('退出出车系统成功');location.href='../login/index.php'</script>";die;
} else{
	echo "<script>alert('退出登录失败');location.href='../login/index.php'</script>";die;
}