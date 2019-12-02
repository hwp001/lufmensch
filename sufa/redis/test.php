<?php
$redis = new Redis();
$redis->connect('127.0.0.1',6379);
$redis->set("name","redis模块实施成功");
echo $redis->get("name");
