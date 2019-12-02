<?php
//简单计数器实战
$redis = new Redis();
$redis->connect('127.0.0.1',6379);
$strKey = 'Test_bihu_comments';

//设置初始值
$redis->set($strKey,0);

$redis->INCR($strKey);
$redis->INCR($strKey);
$redis->INCR($strKey);

$strNowCount = $redis->get($strKey);

echo $strNowCount;