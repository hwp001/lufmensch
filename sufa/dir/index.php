<?php
//写一个函数，能够遍历一个文件夹的或有文件和子一级文件夹
function my_scandir($dir){
    $files = array();
    if ($handle = opendir($dir)){  //opendir 打开目录句柄
        while(($file = readdir($handle)) !== false){  //一行一行读取句柄
            if ($file != ".." && $file != "."){
                if (is_dir($dir.'/'.$file)){
                    $files[$file] = scandir($dir."/".$file);  //扫描下一级内容，以数组的形式返回
                } else {
                    $files[] = $file;
                }
            }
        }
        closedir($handle);
        return $files;
    }
}

//写一个函数，能够遍历一个文件夹得或有文件和子级文件夹
function my_scandirs($dir){
    $files = array();
    if ($handle = opendir($dir)){
        while(($file = readdir($handle)) !== false) {
            if ($file != "." && $file != '..'){
                if (is_dir($dir.'/'.$file)) {
//                    echo 111;die;
                    $files[$file] = my_scandirs($dir.'/'.$file);
                } else {
                    $files[] = $file;
                }
            }
        }
        closedir($handle);
        return $files;
    }
}

//创建多级目录
function create_dir($path,$mode = 0777) {
    if (is_dir(path)) {
        //如果目录已经存在
        return '目录已经存在';
    } else {
        //目录不存在
        if (mkdir($path,$mode,true)){
            return '目录创建成功';
        } else {
            return '目录创建失败';
        }
    }
}

var_dump(my_scandirs('../../face'));