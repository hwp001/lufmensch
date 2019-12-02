<?php
function getExt($url)
{
    $arr = parse_url($url);
//    var_dump($arr);die;
    $file = basename($arr['path']);
    $ext = explode('.',$file);
    return $ext[count($ext)-1];
}
print(getExt('http://www.baidu.com/abc/de/html.php?id=1'));