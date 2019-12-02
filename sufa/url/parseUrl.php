<?php
//写一个函数，尽可能高效的，从一个标准url里取出文件的扩展名，例如:http://www.sina.com.cn/abc/de/fg.php?id=1需要取出php或.php
//scheme => string http
//host => string www.baidu.com
//path => string /abc/de/fg.php
//query => string  id  = 1


//方案一
function getExt1($url){
    $arr = parse_url($url);
    $file = basename($arr['path']);
    $ext = explode('.',$file);
    return $ext[1];
}

//方案二
function getExt2($url){
    $url = basename($url);
    $pos1 = strpos($url,'.');
    $pos2 = strpos($url,'?');
    if (strstr($url,'?')){
        return substr($url,$pos1+1,$pos2-$pos1-1);
    } else {
        return substr($url,$pos1);
    }
}

$url = "http://www.sina.com.cn/abc/de/fg.php?id=1";
echo getExt1($url);
echo "<hr>";
echo getExt2($url);