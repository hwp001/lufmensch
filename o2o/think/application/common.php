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

//获取树状数据
function getTree($arr,$pid = 0,$level = 1)
{
    static $newArr = [];
    foreach ($arr as $v) {
        if ($v['parent_id'] == $pid) {
            $v['level'] = $level;
            $newArr[] = $v;
            getTree($arr,$v["id"],$level+1);
        }
    }
    return $newArr;
}

//自定义随机数
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

/**
 * 请求接口返回内容
 * @param  string $url [请求的URL地址]
 * @param  string $params [请求的参数]
 * @param  int $ipost [是否采用POST形式]
 * @return  string
 */
function juhecurl($url,$params=false,$ispost=0){
    $httpInfo = array();
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
    curl_setopt( $ch, CURLOPT_USERAGENT , 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22' );
    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 30 );
    curl_setopt( $ch, CURLOPT_TIMEOUT , 30);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
    if( $ispost )
    {
        curl_setopt( $ch , CURLOPT_POST , true );
        curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
        curl_setopt( $ch , CURLOPT_URL , $url );
    }
    else
    {
        if($params){
            curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
        }else{
            curl_setopt( $ch , CURLOPT_URL , $url);
        }
    }
    $response = curl_exec( $ch );

    //????
//    if ($response === FALSE) {
//        //echo "cURL Error: " . curl_error($ch);
//        return false;
//    }
//    $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
//    $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
//    curl_close( $ch );
    return $response;
}



//订单编号
function order_trade_on()
{
    list($t1,$t2) = explode(' ',microtime());
    list($t3,$t4) = explode('.',$t1);
    return $t4*mt_rand(1000,9999);
}










