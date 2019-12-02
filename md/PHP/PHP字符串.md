##### 字符串篇

###### 1、自由转换

###### 2、强制转换

- 没有改变原变量的类型，而是产生新的属性给新的一个变量

```php
$a  = 3;
$b = (string)$a;
var_dump($b); 
output : string(3);
```

- ​	字符串转整型(浮点型)的时候，若字符串前面没有，字符串数字的话，直接为0

  ```php
  $a = "你好1234";
  $b = (int)$a;
  output: int(0)
  ```

- 也可以直接转换为数组类型

  ```php
  $a = 'afja';
  $b = (array)$a;
  ```

###### 3、settype()

​	设置字符串的类型，直接改变变量的类型，作用于原变量；

```php
$a = "32fafhai";
settype($a, 'int');
```

###### 4、具体转换函数

​		intval()转换为整型，floatval()转换为浮点型，setval()转换为字符串,作用于新的变量;

​	只针对标量类型，int float string bool ,不能用于数组类型、对象类型	

```
$a = "500";
$b = intval($a);
$b = floatval($a);

```

###### 5、number_format()

​	number_format("字符串"，小数位数，小数点，千位分隔符)

普通用法：

```php
$number1 = "213123131313";
echo number_format($number1,3);
```



- 格式化
- 四舍五入

###### 6、字符串比较函数

- strcmp();

   整个比较是否相同

  ```php
  <?php
  	$a = 'abc';
  	$b = 'ab';
  	echo strcmp($a,$b);
  output:
  	1
  <?php
  	$a = 'ab';
  	$b = 'ab';
  	echo strcmp($a,$b);
  output:
  	0
  <?php
  	$a = 'ab';
  	$b = 'ab';
  	echo strcmp($a,$b);
  output:
  	-1
  ```

  - strncmp()

    ```php
    <?php
    	$a = 'abc';
    	$b = 'ab';
    	echo strncmp($b, $a,2);
    ouput:
    比较前几个字符串的长度，若两个长度大于或等于这个，则为0 or -1
    ```

  - strcasecmp()

    不区分大小写的字符串比较

    - 看长度
    - 看对应相同长度下对应的字母是否相同
    - 0 1 or -x(不限数)；

    ```php
    <?php
    	$a = 'abc';
    	$b = 'ab';
    	echo strcasecmp($a, $b);
    ```

  - strnatcmp()

    - 字符串的模糊比较，按自然数进行；

  - similar_text();

    - 返回相似字符串的个数；
    
    - 就算是重复的字母也是一一对应的关系，不会删掉多于重复的字符串；
    
    - ```
      similar_text("","",$v);
      $v返回的是相似的百分比
      ```
    
      

###### 7、字符串的分割与拼装

- explode()

  - 使用一个字符串分割另一个字符串，进来的是字符串，出去的是一个数组

  - 语法：array explode ( string separator, string string [, int limit] )
    此函数返回由字符串组成的数组，每个元素都是 string 的一个子串，它们被字符串separator 作为边界点分割出来。如果设置了 limit 参数，则返回的数组包含最多 limit 个元素，而最后那个元素将包含 string 的剩余部分。 

- implode()

  - 无参直接拼接，有参
- 用一组较小的字符串创建一个大字符串，进来的是数组，出去的是字符串
  - 用一组较小的字符串创建一个大字符串。
    格式：string implode ( string glue, array pieces )
    第一个参数glue是放在第二个参数pieces的元素之间的字符串。可以像下面这样重建简单的逗号分隔的字符串。

- substr()

  - 语法: string substr(string string, int start, int [length]);
    返回值: 字符串
    本函数将字符串 string 的第 start 位起的字符串取出length 个字符，若省略参数 length，则取到字符串末尾 。若 start 为负数，则从字符串尾端往前开始提取。如果length为整数，表示返回length个字符，若为负数，则表示取到倒数第 length 个字符。

  - ```php
    $a = 'a.b.c.d';
    echo substr($a, 1,2).'<br>';
    echo substr($a, -1,1).'<br>';
    echo substr($a, 3,-1).'<br>';
    ```

  - 当substr()的长度被表示为负数的时候，就把这负数当一个从后面往前面数的固定位置，然后输出的是，start到这个位置里面的所有字符；

- strstr()\strchr()\strrstr()
  - 返回字符串中某字符串开始处至结束的字符串。
    语法: string strstr(string haystack, string needle);
    返回值: 字符串
    本函数将 needle 最先出现在 haystack 处起至 haystack 结束的字符串返回。若找不到 needle 则返回 false
    
  - stristr()
    
    不区分大小写查找代码
    
    ```
    $str1 = stristr("abc","BC")；
    ```
    
  - strtr()
  
    - 替换里面的字符串
  
    - ```php
      echo strtr("www.houdunwang.com",'ham',HAM);//将里面的h a m换成大写的
      
      2、$arr = array("h"=>"H","a"=>"A","m"=>"M");
      echo strtr("www.houdunwanq.com",$arr);
      
      ```
  
      
  
- strpos()
  - 寻找字符串中某字符最先出现的位置。默认从 0 开始。
    语法: int strpos(string haystack, string needle, int [offset]);
    本函数用来寻找字符串 haystack 中的字符 needle 最先出现的位置。若找不到指定的字符，则返回 false 值。参数 offset 可省略，用来表示从 offset 开始找。

- strrpos( )
  - 寻找字符串中某字符最后出现的位置。
    语法: int strrpos(string haystack, char needle);
    返回值: 整数
    本函数用来寻找字符串 haystack 中的字符 needle 最后出现的位置。若找不到指定的字符，则返回 false 值
  
- stripos()

  - 不缺分大小写，查找某字符最先出现位置

- strtok()

  - 通过“符号”拆分字符串中的某一字符串

    拆分了第一次之后就会记住字符串，下面可以继续操作

  - ```php
    $str4 = "php,java,c";
    $s = strtok($str4,","); =>output  php
    echo strtok(","); =>output java
    ```

- **substr()和strpos()联合用法**

  - parse_str()会截取字符串中，等号前面的拿一个字符串作为变量；

  ```php
  $url = "http://www.houdunwang,com?uname=zangsan&age=33&sex=boy";
  $u_msg = substr($url,(strpos($url,'?')+1));
  @parse_str($u_msg);
  echo "欢迎来到后盾网，你的用户名是: ".$uname."你的年龄{$age},你的性别{$sex}";
  ```

  - parse_url() 解析url,返回其组成部分
  - 

- chunk_spilt()

  - 将字符串按照数量拆分，中间可以用连接符链接

  - ```php
    $str6 = "php,mysql,divcss,dreamweaver";
    echo chunk_split($str6,3,"-----");
    output:
    php----- my------ sql------
    ```

- substr_countJ()函数

  查找一个字符串再另外一个字符串出现的次数，和similiar_text()（字符串中有多少相似的）有区别；

###### 8、去除空格和字符串填充函数

- ltrim()

  语法: string ltrim(string str[, string charlist] );
  返回值: 字符串
  本函数用来删去字符串中的前导空格 (whitespace)。

- rtrim()

  语法: string rtrim(string str[, string charlist] );
  返回值: 字符串
  本函数用来删去字符串中的后缀空格 (whitespace)。

- trim( )截去字符串首尾的空格。

  语法: string trim(string str[, string charlist] );
  返回值: 字符串
  本函数返回字符串 string 首尾的空白字符去除后的字串。

- str_pad() 按需求对字符串进行填充。

  语法：string str_pad ( string input, int pad_length [, stringpad_string [, int pad_type]] )
   – STR_PAD_ LEFT 字符串左添补
  – STR_PAD_ RIGHT 字符串右添补
  – STR_PAD_ BOTH 字符串两端添补，多出来的一侧始终是右侧

###### 9、字符串大小写的转换

- strtolower( )

  语法: string strtolower(string str)
  本函数将字符串 str 全部变小写字符串。

- strtoupper( )

  语法: string strtoupper(string str);
  本函数将字符串 str 全部变大写字符串。

- ucfirst()

  语法: string ucfirst(string str)
  本函数返回字符串 str 第一个字的字首字母改成大写。

- ucwords( )

  语法: string ucwords(string str)
  本函数返回字符串 str 每个字的字首字母全都改成大写。

```php
	echo "<br>";
	$a = "hello word";
	$b = "HELLO WORD";
	echo "全部变小写".strtolower($b)."<br>";
	echo "全部变大写".strtoupper($a)."<br>";
	echo "第一个字的字首字母变大".ucfirst($a)."<br>";
	echo "每个字的字首字母变大".ucwords($a)."<br>";
```

###### 10、和HTML标签相关联的字符串格式化

- nl2br( )

  – 语法：string nl2br ( string string )
  将字符串中”\n”转成HTML换行符“<br / >

- urlencode()

  字符串编码

- urldecode()

  解码已编码的内容

- htmlspecialchars（）

  – 语法：string htmlspecialchars ( string string [, intquote_style [, string charset]] )（！常用在表单提交等操作，避免用户破坏网页布局，不转换网页标签）
  
  把指定特殊符号（字符串）转换成实体，不处理中文，比下面者个函数弱一些，参数和下面一样；
  ![](C:\Users\Administrator\Desktop\学习资料\md\img\he.png)
  
  - htmlspecialchars_decode()可以将已经转换为HTML实体的内容，转换为字符串

- htmlentitiese()

  不解析html标签，将字符串转化为html实体

  ​	1、参数：操作内容

  ​	2、转换规则（可选参数）：

  ​			ENT_COMPAT  默认单只转换双引号

  ​			ENT_QUOTOs 默认只转换单双引号

- strip_tags()

  - 去除html标签

  - ```php
    strip_tags($);
    strip_taps($,"保留标签");
    ```

    

###### 11、字符串翻转函数

- strrev()

  将字符串逆序翻转；

- md5()加密函数

  几乎破解不了

###### 12、字符串输出

- echo()可以输出一个或多个字符串；
- print()只能输出一个字符串；
- print_r()输出类型和值，数组同时输出键和值；
- printf() 格式化输出，可以替换一个好多个参数；
- sprintf() 变量，可以替换一个或多个参数；

###### 13、字符串替换函数

- str_replace()  区别（strtr）

  - 替换字符串或者数组，区分大小写，第四个参数统计替换次数

  ```php
  $str1 = "hhhwwwbb";
  str_replace('h','H',$str1);
  ```

- str_ireplace()

  - 不区分大小写

###### 14、转义函数

字符串的自动转义，一般结合数据库插入，读取数值进行使用

- addslashes() 手动
  - 在预定义字符串前添加反斜杠，转义
- php.in  自动
  - 文件下的magic_quotes_gbc = On;开启自动转义
- get_magic_quotes_gpc（）  只有获取没有设置
  - 获取php.in是否开启还是关闭开启
  - 返回0关闭，返回1开启

***如果系统默认转义开启，就不要使用addslashes()进行转义，不然会双重转义；**

- stripslashes()把转义字符串前面的反斜杠删除


###### 读取数据库或外部文件进行转义

- get_magic_quotes_runtimes()  读取

  获得外部文件以数据库资料是否进行转义

- set_magic_quotes_runtimes()   设置    0关闭   1打开

  获得外部文件以数据库资料是否进行转义

















