<?php
//实现页面跳转

//方法一 php函数跳转，缺点，header头之前不能有输出，跳转后得程序继续执行，可以用exit中断执行后面得程序
header("Location:网址");//直接跳转
header("refresh:3;url=http://www.baidu.com");//三秒后跳转

//方法二 利用meta
echo "<meta http-equiv=refresh content='0;url=网址'>";