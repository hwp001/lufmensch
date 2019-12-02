# 数据库

### 数据库连接方式

##### Mysqli

- 而php—mysqli，字母i代表的 Improvement ，提更了相对进阶的功能。

- 优点

  - mysql是非持继连接函数而mysqli是永远连接函数

    也就是说mysql每次链接都会打开一个连接的进程

    而mysqli多次运行mysqli将使用同一连接进程,从而减少了服务器的开销 

- PHP与Mysqli扩展,面向过程、对象

  ```php
  <?php
  $mysql_conf = array(
      'host'    => '127.0.0.1:3306', 
      'db'      => 'test', 
      'db_user' => 'root', 
      'db_pwd'  => 'joshua317', 
      );
  
  $mysqli = @new mysqli($mysql_conf['host'], $mysql_conf['db_user'], $mysql_conf['db_pwd']);
  if ($mysqli->connect_errno) {
      die("could not connect to the database:\n" . $mysqli->connect_error);//诊断连接错误
  }
  $mysqli->query("set names 'utf8';");//编码转化
  $select_db = $mysqli->select_db($mysql_conf['db']);
  if (!$select_db) {
      die("could not connect to the db:\n" .  $mysqli->error);
  }$sql = "select uid from user where name = 'joshua';";
  $res = $mysqli->query($sql);
  if (!$res) {
      die("sql error:\n" . $mysqli->error);
  }
   while ($row = $res->fetch_assoc()) {
          var_dump($row);
      }
  
  $res->free();//释放资源
  $mysqli->close();//断开连接
  ?>
  ```

##### PDO

- PHP与PDO扩展,面向过程、对象

  ```php
  <?php
  $mysql_conf = array(
      'host'    => '127.0.0.1:3306', 
      'db'      => 'test', 
      'db_user' => 'root', 
      'db_pwd'  => 'joshua317', 
      );
  $pdo = new PDO("mysql:host=" . $mysql_conf['host'] . ";dbname=" . $mysql_conf['db'], $mysql_conf['db_user'], $mysql_conf['db_pwd']);//创建一个pdo对象
  $pdo->exec("set names 'utf8'");
  $sql = "select * from user where name = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(1, 'joshua', PDO::PARAM_STR);
  $rs = $stmt->execute();
  if ($rs) {
      // PDO::FETCH_ASSOC 关联数组形式
      // PDO::FETCH_NUM 数字索引数组形式
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          var_dump($row);
      }
  }
  
  $pdo = null;//关闭连接
  ?>
  ```

- ```php
  <?php
  try{
  	$pdo = new PDO('mysql:host=localhost;dbname=yijiangbang;charset=utf8','root','');
  }catch(PDOException $e){
  	die('数据库连接失败'.$e->getMessage());
  }
  //预处理
  $sql = "select * from district where upid = ?";
  $stmt = $pdo -> prepare($sql);
  
  $stmt -> bindValue(1,$_GET['upid']);
  $stmt -> execute();
  
  //解析结果集
  $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
  //var_dump($list);
  //使用json格式传前台
  echo json_encode($list);
  ```

  




### mysqli类的变量 && 方法

##### __construct()

- 用于创建一个新的mysqli对象，也可以建立一个连接

##### connect()

- 打开一个新的连接到MySQL数据库服务器

##### close()

- 关闭先前打开的连接

##### query()

- 与数据库的任何交互都是通过查询进行的，该方法向数据库发送查询语句来执行

##### select_db()

- 为数据库查询选择默认数据库

##### set_charset()

- 设置默认客服端字符集

##### $error

- $connect_error

- 返回最近函数的错误信息字符串

##### $errno

- $connect_errno
- 返回最近函数的错误代码





### mysqli结果集方法

##### fetch_assoc()

- 返回对应结果集的关联数组，并且继续移动内部指针

##### free()

- 释放所有与结果集所关联的内存



统计一个表中不同的字段类型

```
SELECT date,SUM(CASE type WHEN "win" THEN 1 ELSE 0 END) win,
              SUM(CASE type WHEN "lose" THEN 1 ELSE 0 END) lose FROM 
test2 GROUP BY date;
```



### PDO的变量&&方法

##### prepare

- 准备要执行的语句，并返回语句对象(PDOStatement)

- public PDO::prepare ( string `$statement` [, array `$driver_options` = array() ] )

- 语句里面可以用零个或多个参数（名称必须唯一）代替 为execute()方法准备待执行的SQL语句

- 格式是命名（:name）或问号（?）的形式，当它执行时将用真实数据取代

- ```php
  <?php
  /* 传入数组的值，并执行准备好的语句 */
  $sth = $dbh->prepare('SELECT name, colour, calories
      FROM fruit
      WHERE calories < ? AND colour = ?');
  $sth->execute(array(150, 'red'));
  $red = $sth->fetchAll();
  $sth->execute(array(175, 'yellow'));
  $yellow = $sth->fetchAll();
  ?>
  ```

  ```php
  $sql = 'SELECT name, colour, calories
      FROM fruit
      WHERE calories < :calories AND colour = :colour';
  ```

##### query

- 执行查询工作

##### exeu

- 执行增删改操作

### PDOStatement方法

##### bindValue()

- 绑定一个值到用作预处理的 SQL 语句中的对应命名占位符或问号占位符。返回 布尔值
  - "?" 按照索引方式赋值
  - ":name"按照名字赋值

- ```php
  PDOStatement::bindValue ( mixed $parameter , mixed $value [, int $data_type = PDO::PARAM_STR ] ) : bool
  ```

##### bindParam ()

- 绑定一个参数，其他如上

##### execute()

- 增删改查

- 执行一条预处理过的语句，如果里面有参数，必须把参数赋值

  - 第一种赋值如上
  - 第二种赋值为数组的形式作为入参"键为参数，值为赋值"，参数超出报错

- ```php
  PDOStatement::execute ([ array $input_parameters ] ) : bool
  ```

##### fetchAll ()

- 返回一个包含结果集所有行的数组

- ```php
  PDOStatement::fetchAll ([ int $fetch_style [, mixed $fetch_argument [, array $ctor_args = array() ]]] ) : array
  ```

-  `fetch_style` 参数的值

  - **PDO::FETCH_COLUMN**：返回指定以0开始索引的列
  - **PDO::FETCH_CLASS**：返回指定类的实例，映射每行的列到类中对应的属性名。
  - **PDO::FETCH_FUNC**：将每行的列作为参数传递给指定的函数，并返回调用函数后的结果

##### setAttribute()

- 给语句设置一个属性

- PDO::ATTR_CASE:强制列名为指定大小写

- PDO::CASE_UPPER：强制列名大写

- PDO::CASE_LOWER:强制列名小写

- PDO::CASE_NATURAL:保留数据库驱动返回的列名

- PDO::ATTR_ERRMODE:错误提示

- PDO::ERRMODE_SILENT:不显示错误信息，只显示错误码

- PDO::ERRMODE_WARNING:显示警告错误

- PDO::ERRMODE_EXCEPTION:抛出异常

  ```php
   $pdo->setAttribute(PDO::ATTR_CASE,PDO::CASE_UPPER);
   $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  ```

- ```php
  <?php
  try{
  	//实例化对象
  	$pdo = new PDO("mysql:host=localhost;dbname=hwp","root","hwp",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
  	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  
  	//开启事务
  	$pdo->beginTransaction();
  
  	//执行sql语句  这里要返回受影响的行数
  	$pdo->exec("insert into test values('系哦啊名','1234');");
  	$pdo->exec("select * from test;");
  
  	//提交事务
  	$pdo->commit();
  	echo "提交事务";
  }catch(PDOException $e){
  	//回滚事务
  	$pdo->rollBack();
  	echo "数据回滚";
  }
  ```

  

### php事务

- 事务就是一组原子性的SQL查询，或者一个独立的工作单元
- [事务详解](https://www.php.cn/php-ask-430549.html)
- 在某些程序在执行的时候需要进行多个动作，而我们的业务要求是某个动作在执行错误的时候该进程所有的动作不再执行，全部执行成功才算成功，否则就回到执行之前的状态，这就需要用到事务的处理；
- 开启事务，我可以监听我对数据库的操作

```php
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>

//PDO
//数据访问抽象层
<?php

//1.操作其它数据库
//2.事务功能
//3.防止SQL注入攻击

//造PDO对象
//$dsn = "mysql:dbname=mydb;host=localhost"; //数据源 （"数据库类型：数据库名称=名称；连接地址=什么什么；"）
//$pdo = new PDO($dsn,"root","123"); 数据源,用户名,密码

//写SQL语句
//$sql = "select * from nation";
//$sql = "insert into nation values('n077','数据')";

//执行,返回的是PDOStatement对象
//$a = $pdo->query($sql); //执行查询
//$a = $pdo->exec($sql); //执行其他语句

//var_dump($a);

//$arr = $attr->fetchAll(PDO::FETCH_BOTH);
//var_dump($arr);


//事务功能
//事务：能够控制语句同时成功同时失败，失败时可以回滚

$dsn = "mysql:dbname=mydb;host=localhost";
$pdo = new PDO($dsn,"root","123");

//设置异常模式
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 

try
{
    //开启事务
    $pdo ->beginTransaction(); 
    
    $sql1 = "insert into nation values('n080','是删')";
    $sql2 = "insert into nation values('n070','好几款')";
    $sql3 = "insert into nation values('n075','好几款')";
    
    $pdo->exec($sql1);
    $pdo->exec($sql2);
    $pdo->exec($sql3);
    
    //提交
    $pdo->commit();
}
catch(Exception $e)
{
    //抓住try里面出现的错误，并且处理
    //echo $e->getMessage(); //获取异常信息
    
    //回滚
    $pdo->rollBack();
}
//final()
//{
    //最终执行，无论以上try代码有没有出错，都会执行
//}



?>

</body>
</html>
```

### 数据库注入

- 在数据库执行预编译的语句的时候，最容易受到用户各种数据库语句注入、破解，通过改变SQL语句的形式，屏蔽掉后台管理人员登录验证的形式，从而达到用户的目的；

  - 针对后台管理人员直接将输入作为条件进行查询

  - 第一种，数据库判断没有加上(mysqli_affected_rows()>0)

    - 输入请求，第一个字段输入“true”,后面字段不输入或输入任何字段，数据库语句都会执行成功；

    - ![](C:\Users\Administrator\Desktop\学习资料\taskNote\md\image\防注入.png)但是我的受影响行数为 0

    - ![](C:\Users\Administrator\Desktop\学习资料\taskNote\md\image\防注入1.png)

    - 

      ```php
      <?php
      $a = $_GET['a'];
      $b = $_GET['b'];
      var_dump($a);
      $link = new mysqli('localhost','root','hwp','hwp') or die('数据库连接失败');
      $sql = "select * from student where stu_id = '{$a}' and age = '{$b}'";
      var_dump($sql);
      
      if ($res= $link->query($sql)) {
      	var_dump(mysqli_affected_rows($link));
      	echo "<script>alert('注入成功');window.location.href='./6.php';</script>";
      } else {
      	echo "注入失败";
      }
      ```

    - 因此这第一种解决防注入的方式，只要我的影响行数判断大于0就行了，切记在以后的数据库判断中，加上这一句话，可以减少很多问题的产生；

      - ![](C:\Users\Administrator\Desktop\学习资料\taskNote\md\image\防注入 (2).png)

  - 第二种,数据库判断有加上(mysqli_affected_rows()>0)

    - 上面的写法只是语句执行成功了，影响行数始终为0，解决的办法，就是想方法让我们的影响行数大于0，因此只要屏蔽掉条件语句，让条件永远为true，就可以返回出所有的影响行数;

      - ![](C:\Users\Administrator\Desktop\学习资料\taskNote\md\image\防注入 (3).png)

      - 在URL中输入请求    $a = ' or  1=1 -- '     

        - ![](C:\Users\Administrator\Desktop\学习资料\taskNote\md\image\防注入 (4).png)

        - 在数据库中查看 ，可以知道 “--”后面的语句全部被屏蔽掉，只剩下

          “where stu_id=''  or   1=1”     可以知道or 1=1 永远为true,结果返回全部行数的数据

          ![](C:\Users\Administrator\Desktop\学习资料\taskNote\md\image\防注入 (5).png)

      - 在SQL查询语句中，含变量字段没有单引号的情况下

        - ![](C:\Users\Administrator\Desktop\学习资料\taskNote\md\image\防注入 (6).png)

        - ![](C:\Users\Administrator\Desktop\学习资料\taskNote\md\image\防注入 (7).png)

          其他同上

















