<?php
$fp = fopen("test.txt","w+");
if (flock($fp,LOCK_EX)){
    //获得写锁，写数据
    fwrite($fp,"write something\n");
    //解除锁定
    flock($fp,LOCK_UN);
} else {
    echo 'file is locking...';
}
fclose($fp);