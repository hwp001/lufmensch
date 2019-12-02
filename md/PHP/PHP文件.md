文件

### 文件函数

##### .  /

- .  根目录
- /  当前目录
- 遍历目录的时候，注意路径补全

##### disk_total_space();

- 一个参数 （路径）
- 获得总的磁盘空间，单位字节

##### disk_free_space()

- 别名：disk_free_space()

- 一个参数（路径）
- 剩余空间

##### basename()

- 两个参数，(路径地址，字符串)

  - 路径地址必选；字符串可选，舍去

- 返回路径中的文件名部分

- 实例：

  - ```php
    echo basename('file1.php','.php');
    output:
    file1
    ```

    

##### dirame()

- 得到路径中的目录部分
- 嵌套使用，得到上一级的目录部分

##### file_exist()

- 一个参数，文件名 or 目录名
- 判断文件或目录是否存在

##### filetype()

- 一个参数，文件名 or 目录名
-  检查文件或目录类型

##### is_dir()

- 一个参数
- 判断是否参数是否为一个目录
- 返回布尔型  

##### mkdir()

- 创建目录，第一个参数指定目录名（必选），第二个参数目录权限（可选）， 第三个参数为TRUE则递归创建目录（可选）
- 若是只有一个参数，在多重路径下，其中一重路径不存在，则会报错，有第三个参数，则会递归创建目录

##### getcwd()

- 返回当前操作目录

##### chdir()

- 更改当前操作目录



### 目录操作

##### scandir() 

- 显示文件夹内的所有内容，返回数组，包括 .  与 ..
- 不返回具体路径，只会返回文件目录名
- 循环遍历的时候(遍历多个文件夹，大小)，要去掉，.  ..   or  死循环

##### glob()

- 以数组的方式返回路径形式的文件名（不包含 . 和 ..）

- 一个参数 ，参数为字符串， 字符串搭配（目录名 .   /   *   .   后缀名   ）

- glob('./*.  *')  后面的一个  *  表示 任意数量的任意值（各种类型）

- 实例:

  - ```php
     <?php
      
     $dir = glob('./*');
     echo "<pre>";
     print_r($dir);
    output:
    Array
    (
        [0] => ./file1.php
    )
    ```

  - 返回后缀名以 .txt  结尾的路径形式的文件名

    ```php
     <?php
    
     $dir = glob('./*.txt');
     echo "<pre>";
     print_r($dir);
    output:
    Array
    (
        [0] => ./file4.txt
    )
    ```



注意：

1、把这一整个过程想象成可视化操作文件；

- 只有打开文件夹，才能读取文件夹内容
- 只有关闭了文件夹，释放资源，才能对文件夹进行删除操作
- 类似任务管理器中的进程，进程运行中，没有结束，删除不了

##### opendir()

- 比glob()稳定
- 打开文件夹
- 搭配closedir();

##### readdir()

- 读取文件夹

- 返回的是文件名

- 内部指针第0开始

  ```php
   <?php
  
  $dir = opendir('a');
  while ($file = readdir($dir)) {
  	echo $file."<br/>";
  }
  closedir($dir);
  ```

  

##### closedir()

- 关闭文件夹

##### rmdir()

- 删除文件夹

- **该文件夹必须为空**

- ```php
   <?php
    
  if (!is_dir('a')) {
  	mkdir('a');
  }
  rmdir('a');
  ```

- 当文件夹里面还有文件（不包括目录），配合glob使用

  ```php
  <?php
  
  $arrFile = glob('a\*');
  // echo "<pre>";
  // print_r($arrFile);
  foreach ($arrFile as $value) {
  	
  	if (unlink($value))  
  		echo "{$value} 删除成功<br/>";
  	else
  		echo "{$value} 删除失败<br/>";
  }
  echo "<br/>";
  if (rmdir('a')) {
  	echo "a 删除成功";
  }
  ```

- 结合array_map使用（不包括目录，有目录递归） 

  ```php
  <?php
  
  if (!is_dir('a')) {
  	echo "a 文件不存在";
  }
  $arrFile = glob('a/*');
  array_map('unlink', $arrFile);
  if (rmdir('a')) {
  	echo "a 文件删除成功";
  }else{
  	echo "删除失败";
  }
  
  ```

- 包含目录操作，删除多种类型文件（结合数组使用）

   ```PHP
   <?php
   
   function del($dirname, $type) {
   	$dir = opendir($dirname);
   	while (($file = readdir($dir)) != FALSE) {
   			$filename = $dirname.'\\'.$file;
   			if ($file != '.' && $file != '..') {
   				if (is_dir($filename)) {
   					del($filename, $type);
   				}
   				if (is_file($filename) && strrchr($file,'.') == $type) {
   					unlink($filename);
   				}
   			}
   	}
   
   }
   del('a','.php');
   ```

   

##### dir()

- 一个参数，输入的不是当前目录的话，参数为目录具体路径
- 生成包含此目录下所有文件的对象

- ```php
  <?php
  $dir = dir('.');
  while (($file = $dir->read()) !== FALSE) {
  	echo $file."<br/>";
  }
  $dir->close();
  $dir->rewind();//移动 内部指针到顶部
  ```



### 文件操作

##### fliesize()

- 一个参数，字符串（文件名）
- 得到文件大小，返回单位为自己
- 尽量不要直接对目录进行操作

##### unlink()

- 删除文件

- ```php
  //删除60目录下所有的doc文件
  array_map(unlink, glob('60\*.doc'));
  ```


##### is_executable()

- 判断是否为可执行文件

##### is_readable()

- 文件是否可读

##### is_wtitable()

- 文件是否可写 

##### fopen()

- 两个参数，一个文件名，一个为属性（可读，可写）

- 打开文件（类似鼠标单击文件打开）

- 可以读取远端的内容

  - php.in -》allow_urls_fopen  : on

  - ```php
    fopen('http://www.baidu.com','r')
    ```

- b模式  t模式

  - 读取图片等内容，权限方式写成   'rb' ,更加安全，否图片可能为坏图

  ```php
  fopen('logo.png','rb')
  ```

  - wt   会默认在文本将\n体现出来

- ![](C:\Users\Administrator\Desktop\学习资料\md\picture\fopen.png)



##### fread()

- 两个参数，一个为需要读取的变量，一个为读取的字节大小

- 读取内容（内部操作指针读取）

- ```php
  <?php
  
  $file =  fopen('name.txt', 'r');
  
  echo fread($file, filesize('name.txt'));
  ```

  

##### fclose()

- 关闭文件，释放资源

##### fwrite()

- 两个参数，一个要写入的文件路径，一个是写入的内容

- 改写的方式


##### fgetc()

- 一个参数，文件操作句柄（fopen()后的）
- 一次获得一个字节

##### fgets()

- 有两个参数，文件操作句柄（fopen()后的），一个为内容多少字节

- ```php
  fgets($file);
  fgets($file,1024);
  ```

##### feof()

- 内部操作指针是否到达某尾

- ```php
  while(!feof($file)){
  	echo fgets($file)."<br/>"
  }
  ```

##### fgetss()

- 每次读取一行内容，过滤掉html,php标签，第二个参数内容大小， 第3个参数指定保留标签

##### file_get_contents()

- 可以用于采集网络资源
- 一个参数，文件名（本地 远程）
- 集合 fopen fread fclose一身，直接把内容获取在网页上（效率更好）

##### file_put_contents()

- 两个参数 ，一个写入文件名，一个为写入内容
- 集合 fopen fwrite fclose一身，若文件不存在，会创建文件（w模式）

##### ord()

- 获取字符的ASCII码值
- ord(' ')>0xa0  则可以判定此字符串是一个中文字符；
- GBK中文字符，保存 **两** 个字节；utf8保存 **三** 个字节；

##### file()

- 两个参数，第一个参数为文件名（必选），第二个参数（可选）  1  表示在指定目录中的文件不存在，就会在php.ini中指定的目录中读取内容
  - 在php.ini 中打开   include_path
  - 指定  1   会受  include_path 的影响
  - set_include_path()  
    - （优先级较高）设置默认载入目录，就不用打开php.ini设置 
- 以数组的方式，一行一行存入文件内容
- 集合了fopen fwrite fclose一身

##### copy()

- 两个参数，第一个旧文件，第二个新文件(文件名重会覆盖替换)

- 拷贝文件

- ```php
  copy('houdunwang.txt', 'hdw/c.txt');
  ```

##### rename()

- 两个参数，第一个原文件名 ，第二个新文件名 
- 文件重命名  ： 路径相同
- 文件剪切      ： 路径不同

##### filectime()

- 获得文件的修改时间  
- 形式为时间戳，需要date()函数转换

##### filemtime()

- 获得文件内容的修改时间
- 形式为时间戳
- 多个filemtime()会将时间读取缓存，造成同时的情况

##### clearstatcache()

- 清除多个filemtime()时间读取缓存，产生顺序读取的差异性

##### fileatime()

- 文件的访问时间

- 访问时间动态变化    cmd打开   0 关闭  1 打开

- ```
  fsutil behavior set disablelastaccess   0/1
  ```

##### touch()

- 两个参数，第一个参数（必选）文件名，第二个参数为修改后时间
- 只有第一个参数，返回当前时间
- 强制修改访问时间

##### pathinfo()

- 以数组的方式返回，文件名，文件路径信息，文件扩展名

##### realpath()

- 把相对路径信息，转化为绝对路径信息 

- ```php
  dirname(_FILE_);
  realpath('.');
  ```

##### flock()

- 两个参数，文件名，锁状态

- 对文件进行锁定

- 锁状态

  - LOCK_EX   写入  ，LOCK_UN   锁释放  ，LOCK_SH只能读取读不能写入内容;

    ```php
    <?php
    
    $file = fopen('name.txt', "r+");
    flock($file, LOCK_EX);
    fwrite($file,"css视频教程");
    sleep(3);
    flock($file, LOCK_UN);
    fclose($file);
    ```

  - LOCK_EX+LOCK_NB  一个时刻只能有一种锁，防止阻塞 造成死锁

    ```PHP
    <?php
    
    $file = fopen('name.txt', "r+");
    flock($file, LOCK_EX + LOCK_NB);
    fwrite($file,"css视频教程");
    sleep(3);
    flock($file, LOCK_UN);
    fclose($file);
    
    ```

##### tempnam()

- 两个参数 ，第一个参数路径，第二个参数文件结构
- 随机生成一个不重名的 tmp格式临时文件
- 返回文件名信息，路径， 永久存在

##### tmpfile() 

- 返回一个文件操作句柄
- 生命周期 
  - fclose()关闭
  - 脚本运行结束

##### readfile()

- **readfile**( string `$filename `[, bool ` $use_include_path` = false[, resource `$context `]] ) : int

- 读取文件并写入到输出缓冲。

- 返回值：返回从文件中读入的字节数。如果出错返回**FALSE** 并且除非是以@**readfile()** 形式调用，否则会显示错误信息。

- 一般结合header()函数实现下载

  ```php
  <?php
  
  	$file = $_GET['file'];
  	if (file_exists($file)) {
  		$filename = basename($file);
  	header("Content-Type:application/octet_stream");//文件可以为任意模式
  	header("Content-Disposition:attachment;filename={$filename}");//以附件的形式    filename指出文件格式
  	readfile($filename);  //强制输出
  	} else {
  		echo "文件内容错误";
  	}
  
  ```

  



























### 内部指针操作

##### ftell()

- 得到当前指针所在的位置

##### fseek()

-  三个参数 ，第一个参数为文件名，第二个参数为指针移动的范围，第三个参数（可选）表示指针开始移动位置

  - SEEK_CUR  （当前位置）相对于第一个指针的位置开始移动
  - SEEK_ED    从文章的末尾开始移动

- ```php
  <?php
  
  $file = fopen('file6.php','r');
  fseek($file, 20);
  fseek($file, 100, SEEK_CUR);
  echo ftell($file);
  output:
  120
  ```

##### rwind()

- 文件指针重定位

##### fpassthru()

- 当前指针位置向后的内容全部输出来，
- 从当前位置读取给定文件指针的EOF，并将结果写入输出缓冲区。
- 如果已经向文件写入了数据，可能需要调用rewind()将文件指针重置为文件开头。









### 文件上传

#### 文件上传配置

##### 1、打开上传功能

- php.in         file_uploads = On / Off 

##### 2、上传位置

- php.in   		upload_tmp_dir ="D:/wamp64/tmp"

- _FILES        

  - 以数组的方式读取上传到临时文件夹的临时文件显示在浏览器，并在临时文件夹中删除;

- 实例1：

  - ```html
    <!DOCTYPE html>
    <html>
    <head>
    	<meta charset="UTF-8">
    	<title>上传表单</title>
    </head>
    <body>
    	<form action="file8.php" method="post" enctype="multipart/form-data">
    		<input type="hidden" name="MAX_FILE_SIZE" value="2000"><!--上传一个隐藏域，能够对文件大小等限制有一个预防作用，放在头部，否则失效-->
    		文件上传：<input type="file" name="file1">
    		<br/>
    		<input type="submit" value="上传文件">
    	</form>
    </body>
    </html>
    ```

  - error:

    - 0  没有任何错误
    - 1   文件大小超过了PHP.INI的配置
    - 2  超过了前台表单指定的文件大小（max_file_size）
    - 3 只上传了文件的一部分
    - 4 没有上传任何文件

    ```php
    <?php
    echo "<pre>";
    sleep(4);
    print_r($_POST);
    print_r($_FILES);
    
    output:
    
    Array
    (
        [file1] => Array
            (
                [name] => 2.png
                [type] => image/png
                [tmp_name] => D:\wamp64\tmp\php441F.tmp
                [error] => 0  
                [size] => 13620
            )
    
    )
    ```

    

##### 3、文件上传大小

- php.in 			upload_max_filesize = 2M

##### 4、脚本运行最大时间

- php.in			max_execution_time = 120   （秒）

##### 5、内存大小

- php.in 			memory_limit = 128M

#### 文件上传有关函数

##### is_uploaded_file()

- 判断此上传文件是否存在
- is_uploaded_file($_FILES['upfile'] ['tmp_name'])

##### move_uploaded_file()

- 两个参数，第一个为旧文件，第二个为新的路径（包括文件名‘重命名将会覆盖’）

- 移动上传文件到新的路径

- move_uploaded_file($_FILES['upfile'] ['tmp_name'],$toFilename)

- 掌握 $_FILES  单文件上传

  ```php
  <?php
  
  $file = $_FILES['file1']['tmp_name'];
  echo "<pre>";
  print_r($_FILES);
  echo "<hr>";
  
  if (is_uploaded_file($file)) {
  	if(move_uploaded_file($file, "abc/nihaoya.jpg")){
  		echo "文件移动成功";
  	} else {
  		echo "文件移动失败";
  	}
  
  } else {
  	echo "error1";
  }
  ```

- 多文件上传

  ```html
  <!DOCTYPE html>
  <html>
  <head>
  	<meta charset="UTF-8">
  	<title></title>
  </head>
  <body>
  	<form action="file11.php" method="post" enctype="multipart/form-data">
  		<input type="hidden" name="MAX_FILE_SIZE" value="200000"><!--上传一个隐藏域，能够对文件大小等限制有一个预防作用，放在头部，否则失效-->
  		文件1：<input type="file" name="file[]"><br/>
  		文件2：<input type="file" name="file[]"><br/>
  		文件3：<input type="file" name="file[]"><br/>
  		文件4：<input type="file" name="file[]"><br/>
  		<input type="submit" value="文件上传">
  	</form>
  </body>
  </html>
  ```

- ```php
  <?php
  echo "<pre>";
  print_r($_FILES);
  output:
  Array
  (
      [file] => Array
          (
              [name] => Array
                  (
                      [0] => 2.png
                      [1] => 2.png
                      [2] => 4.png
                      [3] => 1.png
                  )
  
              [type] => Array
                  (
                      [0] => image/png
                      [1] => image/png
                      [2] => image/png
                      [3] => image/png
                  )
  
              [tmp_name] => Array
                  (
                      [0] => D:\wamp64\tmp\php5A48.tmp
                      [1] => D:\wamp64\tmp\php5A49.tmp
                      [2] => D:\wamp64\tmp\php5A4A.tmp
                      [3] => D:\wamp64\tmp\php5A4B.tmp
                  )
  
              [error] => Array
                  (
                      [0] => 0
                      [1] => 0
                      [2] => 0
                      [3] => 0
                  )
  
              [size] => Array
                  (
                      [0] => 13620
                      [1] => 13620
                      [2] => 18196
                      [3] => 15051
                  )
  
          )
  
  )
  ```

  

### 文件下载

##### a链接下载

- 直接在href 加上路径，因为浏览器没有办法处理doc，rar，zip文件等  就会自动显示下载

##### header()下载

- 文档类型，mime类型

-  header('content-type:()/()')    指定文档类型

  - (大类)/(子类) 
  - image/png  image/gif  image/jpeg
  - application/pdf   application/msword  (doc)application/octet_stream(任意二进制数据)
  - video/mpeg

- header('content-disposition:attachment;filename=eeee.doc');

  - 指定文件处理方式 ：          文件名

- header("Accept-ranges:bytes");计算单位

- header("Accept-length:".filesize('houdunwan.doc'));文件大小

- 实例 ：一般组成部分：文档类型+文档内容

  ```php
  <?php
  
  header('content-type:image/jpg');//文档类型
  
  $file = fopen('./abc/1.jpg','r');//文档内容
  echo fread($file, filesize('./abc/1.jpg'));//数据源
  echo "<br>9999999";
  ```

- ```php
  <?php
  
  	$file = $_GET['file'];
  	if (file_exists($file)) {
  		$filename = basename($file);
  	header("Content-Type:application/octet_stream");//文件可以为任意模式
  	header("Content-Disposition:attachment;filename={$filename}");//以附件的形式    filename指出文件格式
  	readfile($filename);  //强制输出
  	} else {
  		echo "文件内容错误";
  	}
  
  ```

  





















