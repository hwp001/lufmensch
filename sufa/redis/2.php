<?php
//简单队列缓存实战
$redis = new Redis();
$redis->connect('127.0.0.1',6379);
$strQueueName = 'Test_bihu_queue';

//进队列
$redis->rpush($strQueueName,json_encode(['uid'=>1,'name'=>'Job']));
$redis->rpush($strQueueName,json_encode(['uid'=>2,'name'=>'Tom']));
$redis->rpush($strQueueName,json_encode(['uid'=>3,'name'=>'John']));
echo "-------------进队列成功--------------<br /><br />";

//查看队列
$strCount = $redis->lrange($strQueueName,0,-1);
echo "当前队列数据为：<br />";
print_r($strCount);

//出队列
$redis->lpop($strQueueName);
echo "<br /><br />---------出队列成功------<br /> <br />";

//查看队列
$strCount = $redis->lrange($strQueueName,0,-1);
echo "当前队列数据为：<br />";
print_r($strCount);