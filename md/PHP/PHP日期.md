# 日期

### 时区

英国伦敦的本地时间 = GMT = UTC    0时区

//北京时间  东八区  与零时区相差8个小时

##### UTC

- 通用协调时间

##### GMT

- 格林威治时间

##### PRC

- 中华人民共和国时间
- php.in       date.timezone = PRC

##### date_default_timezone_get();

- 获得时区

##### date_default_time_Set();

- 设置时区

### unix时间戳

- 32 二进制表示 -2147483648  +2147483648    1901年  2038年
- window 一部分linux系统中，无法表示负的时间戳，1970年1月1日0时0分0秒  unix世纪元
- 时间戳是指格林威治时间1970年01月01日00时00分00秒(北京时间1970年01月01日08时00分00秒)起至现在的总秒数。通俗的讲， 时间戳是一份能够表示一份数据在一个特定时间点已经存在的完整的可验证的数据。
- 便于计算，跨平台

##### time()

- 返回当前时间戳       
- time()   =   date("U")  =    mktime()

##### strtotime()

- **strtotime**( string `$time`[, int `$now` = time()] ) : int

- 返回到1970至今的时间戳

- 通过英文格式得到指定的时间戳，通过相对的加量减量获得相对应的时间戳

- ```php
  $t3 = strtotime("2011/4/9");
  
  
  <?php
  echo strtotime("now"), "\n";
  echo strtotime("10 September 2000"), "\n";
  echo strtotime("+1 day"), "\n";
  echo strtotime("+1 week"), "\n";
  echo strtotime("+1 week 2 days 4 hours 2 seconds"), "\n";
  echo strtotime("next Thursday"), "\n";
  echo strtotime("last Monday"), "\n";
  echo strtotime("-3 weeks",strtotime("1999/4/2"));//1999/4/2日的前三周
  ?>
  ```

  

##### mktime()

- mktime(时，分，秒，月，日，年)；
- 将当前时间转换为时间戳
- 当前设置的时区时间为准

##### gmmktime()

- 返回0时区的时间戳

- ```php
  <?php
  date_default_timezone_set('PRC');
  $t1 = mktime(3,32,45,7,8,2009);
  $t2 = gmmktime(3,32,45,7,8,2009);
  echo ($t2-$t1)/60/60;
  ```

  

### 时间函数

##### microtime()

- 适用于计算脚本运行时间

- ```php
  echo microtime();
  output:
  0.11132800 1566977628
      
  echo microtime(TRUE);
  output:
  1566977693.7168
  ```

##### gettimeofday()

- 以数组的形式返回时间戳和微秒数
- 无参，或微秒数



##### date()

- 格式化一个本地时间／日期
- **date**( string `$format`[, int `$timestamp`] ) : string

![](C:\Users\Administrator\Desktop\学习资料\md\picture\date01.png)

![](C:\Users\Administrator\Desktop\学习资料\md\picture\date02.png)

```php


```



##### getdate()

- 以数组的方式获得指定时间信息

- ```php
  echo "<pre>";
  print_r(getdate());
  output:
  Array
  (
      [seconds] => 0
      [minutes] => 48
      [hours] => 15
      [mday] => 28
      [wday] => 3
      [mon] => 8
      [year] => 2019
      [yday] => 239
      [weekday] => Wednesday
      [month] => August
      [0] => 1566978480
  )
  
  ```

  

##### strftime() && setlocale()

[详解](https://www.php.net/manual/zh/function.strftime.php)

##### checkdate()

- 验证时间的合法性
- chec







