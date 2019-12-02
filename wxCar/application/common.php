<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


//自定义随机数 盐值
function random()
{
    $str = "abfajfaiojfao72342u389h98hc2eh2xj892c92jx98e2xej298xe";
    $randstr = '';
    //生成6位随机字符串
    for ($i = 0 ; $i < 6; $i++)
    {
        $len = strlen($str);
        $num = mt_rand(0,$len-1);
        $randstr .= substr($str,$num,1);
    }
    return $randstr;
}






