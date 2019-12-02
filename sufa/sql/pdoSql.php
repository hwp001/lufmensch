<?php
try{
  $pdo =  new PDO('mysql:host=localhost;dbname=php',"root","hwp",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
}catch (PDOException $e){
    echo "数据库连接失败";die;
}
$sth = $pdo->prepare('SELECT * FROM test where name = ?');
$sth->execute(['hello']);
$info = $sth->fetchAll();
echo "<pre>";
print_r($info);