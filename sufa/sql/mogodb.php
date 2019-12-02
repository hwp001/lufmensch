<?php
//连接mongo数据库  mongodb://username:password@localhost:27107/dbname
$manager = new MongoDB\Driver\Manager("mongodb://test:123456@localhost:27017/test") or die('MongoDB连接失败');

//实例化一个插入对象
$bulk = new MongoDB\Driver\BulkWrite;
$bulk->insert(['x' => 1, 'name'=>'菜鸟教程', 'url' => 'http://www.runoob.com']);
$bulk->insert(['x' => 2, 'name'=>'Google', 'url' => 'http://www.google.com']);
$bulk->insert(['x' => 3, 'name'=>'taobao', 'url' => 'http://www.taobao.com']);
//把插入对象 插入到 test数据库下面得sites集合里面去
$hello = $manager->executeBulkWrite('test.sites',$bulk);
if ($hello) {
    echo "数据插入成功";
} else {
    echo "数据插入失败";
}

/*//查询条件
$filter = ['x' => ['$gt' => 1 ]];
//查询规则
$options = [
    'projection' => ['_id' => 0],
    'sort' => ['x' => -1]
];
//查询数据  查询对象
$query = new MongoDB\Driver\Query($filter,$options);
//执行查询方法，根据查询规则，查询test数据库里面的sites集合
$cursor = $manager->executeQuery('test.sites',$query);
echo "<pre>";
foreach($cursor as $document){
    print_r($document);
}*/

/*//实例化一个更新对象
$bulk = new MongoDB\Driver\BulkWrite;
$bulk->update(
    ['x' => 2], //条件
    ['$set' => ['name' => '菜鸟工具', 'url' => 'tool.runoob.com']],  //更新操作，覆盖更新
    ['multi' => false, 'upsert' => false]
);

$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY,1000);
$result = $manager->executeBulkWrite('test.sites',$bulk,$writeConcern);
if ($result) {
    echo 'MongoDB更新成功';
} else {
    echo 'MongoDB更新失败';
}*/

/*$bulk = new MongoDB\Driver\BulkWrite;
$bulk->delete(['x' => 1], ['limit' => 1]);   // limit 为 1 时，删除第一条匹配数据
$bulk->delete(['x' => 2], ['limit' => 0]);   // limit 为 0 时，删除所有匹配数据
$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY,1000);
$result = $manager->executeBulkWrite('test.sites',$bulk,$writeConcern);
if ($result) {
    echo "MongoDB数据删除成功";
} else {
    echo "MongoDB数据删除失败";
}*/
