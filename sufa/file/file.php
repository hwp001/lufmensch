<?php
header("content-type:text/html;charset=utf-8");
//第一种读取方式
$file_path = dirname(__FILE__).'/'.'test.txt';
if (file_exists($file_path)) {
    $fp  = fopen($file_path,"r");
    $str = fread($fp,filesize($file_path));//指定读取大小，这里把整个文件内容读取出来
    echo str_replace("\r\n","<br />",$str);
    fclose($fp);
} else {
    echo '文件不存在';
}
echo "<hr>";

//第二种读取方式
if (file_exists($file_path)) {
$str = file_get_contents($file_path);//将整个文件内容读取到一个字符串中
    echo str_replace("\r\n","<br />",$str);
} else {
    echo '文件不存在';
}
echo "<hr>";

//第三种读取方式   一行 1024 字节
if (file_exists($file_path)) {
    $fp = fopen($file_path,"r");
    $str = '';
    $buffer = 1024;
    while(!feof($fp)){
        $str .= fread($fp,$buffer);
    }
    echo str_replace("\r\n","<br />",$str);
    fclose($fp);
} else {
    echo '文件不存在';
}
echo "<hr>";

//第四种读取方式
if (file_exists($file_path)) {
    $file_arr = file($file_path);
//    var_dump($file_arr);die;
    for ($i=0;$i<count($file_arr);$i++){ //逐行读取内容
        echo $file_arr[$i]."<br />";
    }
} else {
    echo '文件不存在';
}
echo "<hr>";

//第五种方法
if (file_exists($file_path)){
    $fp = fopen($file_path,'r');
    $str = "";
    while(!feof($fp)){
        $str .= fgets($fp); //逐行读取。如果fgets不写length参数,默认是1k.
    }
    echo str_replace("\r\n","<br />",$str);
    fclose($fp);
} else {
    echo '文件不存在';
}










