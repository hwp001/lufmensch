<?php
//设定日期
date_default_timezone_set('Asia/Shanghai');

//检验是否为合法的日期格式
function checkDateTime($data){
    if (date('Y-m-d H:i:s',strtotime($data)) == $data){
        return true;
    } else {
        return false;
    }
}
$data = '2016-06-20 13:35:42';
echo phpinfo();
//var_dump(checkDateTime($data));