[TOC]

# PHP数组

### 常用的数组函数

##### range()

- 生成包含指定范围的数组

##### array_values()

- 一个参数，参数为数组
- 返回 数组中所有的值并给其建立数字索引。

##### array_keys()

- **array_keys**
  ( array `$array`[, [mixed](https://www.php.net/manual/zh/language.pseudo-types.php#language.types.mixed) `$search_value` = null[, bool `$strict` = false]] ) : array

- $search_value指定返回的参数的键名

  - 返回 `input`数组中的数字或者字符串的键名。

- 实例：

  - ```php
    <?php
    $array = array(0 => 100, "color" => "red");
    print_r(array_keys($array));
    
    $array = array("blue", "red", "green", "blue", "blue");
    print_r(array_keys($array, "blue"));
    
    $array = array("color" => array("blue", "red", "green"),
                   "size"  => array("small", "medium", "large"));
    print_r(array_keys($array));
    ?>
    output:
    Array
    (
        [0] => 0
        [1] => color
    )
    Array
    (
        [0] => 0
        [1] => 3
        [2] => 4
    )
    Array
    (
        [0] => color
        [1] => size
    )
    ```

##### array_flip()

- **array_flip**( array `$array`) : array

- 返回一个反转后的 [array](https://www.php.net/manual/zh/language.types.array.php)，例如`array` 中的键名变成了值，而`array` 中的值成了键名。

- 键值能够成为合法的键名

- 实例：

  - ```php
    <?php
    $input = array("oranges", "apples", "pears");
    $flipped = array_flip($input);
    
    print_r($flipped);
    ?>
    output:
    Array
    (
        [oranges] => 0
        [apples] => 1
        [pears] => 2
    )
    ```

##### in_array()

- **in_array**( [mixed](https://www.php.net/manual/zh/language.pseudo-types.php#language.types.mixed) `$needle`, array `$haystack`[, bool `$strict` = **FALSE**
  ] ) : bool
- 检查数组是否存在某个值

##### is_array()

- 一个参数，数组
- 判断是否为数组

##### array_seach()

- 两个参数，（字符串，数组变量）

- 判断数组里面是否有这个字符串，有久返回键名，不存在返回bool

- ```php
  <?php
  	
  	$arr = ["an"=>"nbifa","ar"=>"哈"];
  	$k = array_search("哈", $arr);
  	var_dump($k);
  
  ouput:"ar"
  ```

##### array_change_key_case()

- **array_change_key_case**( array `$array`[, int `$case` = CASE_LOWER
  ] ) : array
- 可以在这里用两个常量，**CASE_UPPER** 或**CASE_LOWER**（默认值）。
- 返回一个键全是小写或者全是大写的数组；如果输入值（`array`）不是一个数组，那么返回**FALSE**

##### array_chunk()

- 将数组进行拆分成规定长度的数组
- array_chunk(input, size);//前面放变量，后面放尺寸

##### array_combine()

- 将若干的数组组成一个新数组

##### array_diff()  

- 返回其它数组中不存在键值

##### array_diff_key()  

- 返回其它数组中不存的键名

##### array_diff_assoc() 

- 返回其它数组中不存在的键名+键值

##### array_udiff

- ($array1,$array2,$data_compare_func);

- 通过回调函数比较2个或多个数组里面的差值，只比较键值，不比较索引，返回的是数组；

##### array_udiff_assoc()

- 通过回调函数，同时比较2个或2个以上的数组里面的键值和键名；

##### array_uintersect()

- ($array1,$array2,func)

- 通过回调函数，取得相同数组里面的交集，只比较健值   返回数组

##### array_uintersect

- ($array1,$array2,func)

- 通过回调函数，同时取得数组里面的交集，比较键名和键值

##### array_pad()

- 往数组中填充元素，第二个参数如果是负数，从左侧添加，正数为右侧；
- array_pad($,长度，填充元素，位置（可选）)
- 类似str_pad()

##### array_product()

- 对数组里面的键值，进行乘积运算，返回数值类型；

##### array_sum()

- 对数组的值进行求和运算

##### array_merge()

- 两个数组合并为一个数组
- 常用于数据库等合并配置信息
- 当键名相同的时候会覆盖掉

##### array_merge_recursive()

- 当键名重名的时候，就会生成二维数组；

##### array_change_key_case()

- 将数组的键名进行大小写转换

##### array_rand()

- array_rand(array,num);

  随机取出数组里面的索引值，num为数量，如果取得多个元素返回的是元素索引的数组，单个只返回这个元素的索引；

- 常常搭配从题库中，取出多少题；

  ```php
  $aa = array(
   		array("name"=>"李四","glod"=>"90"),
   		array("name"=>"王五","glod"=>"80"),
   		array("name"=>"小六","glod"=>"70")
   	);
   
   	$key = array_rand($aa);
   	$key = array_rand($aa，2);
   	print_r($key);
   	echo "<br>";
   
   	if (is_array($key)) {
   			foreach ($key as $v) {
   		}
   	} else {
   		echo $aa[$key]["name"];
   	}
  ```

##### array_reverse()

- 翻转数组的内容，如果第2个参数为真，保留键名

##### array_slice();

- 截取一个范围的数组，原数组不会缺一定区域的值
- array_slice($array,2)    //从索引2开始截取到后面
  - array_slice($array,-2);//从后面数
- array_slice($array,2,2)  //截取长度为2
  - array_slice($array,-2,-1) //-1为位置往前数，-2位置
- array_slice($array,2,2,true)  //保留索引

##### array_splice()

- 指定一定区域内的值，截取到另外一个新数组，原数组缺了一定区域的值
  - ```php
    $array = array(1,2,3,4,5);
    $result = array_splice($array, 2, 1);
    print_r($array);
    echo "<br>=======<br/>";
    print_r($result);
    output:
    Array
    (
        [0] => 1
        [1] => 2
        [2] => 4
        [3] => 5
    )
    
    =======
    Array
    (
        [0] => 3
    )
    
    ```

  - 只有两个参数，他会将索引往后的一并截了

    - ```php
      $array = array(1,2,3,4,5);
      $values = array('ohaiyo','sawadika','你丫');
      $result = array_splice($array, 2);
      print_r($array);
      echo "<br>=======<br/>";
      print_r($result);
      
      output:
      Array
      (
          [0] => 1
          [1] => 2
      )
      
      =======
      Array
      (
          [0] => 3
          [1] => 4
          [2] => 5
      )
      ```

      

  - 操作原数组；

    - 当有第四个参数的时候，往索引的位置插入第四个参数

    - ```php
      $array = array(1,2,3,4,5);
      $values = array('ohaiyo','sawadika','你丫');
      $result = array_splice($array, 2, 1,$values);
      print_r($array);
      echo "<br>=======<br/>";
      print_r($result);
      
      output:
      Array
      (
          [0] => 1
          [1] => 2
          [2] => ohaiyo
          [3] => sawadika
          [4] => 你丫
          [5] => 4
          [6] => 5
      )
      
      =======
      Array
      (
          [0] => 3
      )
      ```










### 数组统计的相关元素

##### count()

- **count**( [mixed](https://www.php.net/manual/zh/language.pseudo-types.php#language.types.mixed) `$array_or_countable`[, int `$mode` =COUNT_NORMAL
  ] ) : int

- 计算数组中的单元数目或对象中的属性个数

- ```php
  $arr =[1,2,3,4,5];
  echo count($arr);
  //
  	$arr = array("nihaoy","滴滴滴",array("niaf","niaofa",4));
  	echo count($arr);
  output: 3
      	$arr = array("nihaoy","滴滴滴",array("niaf","niaofa",4));
  	echo count($arr,1);
  output: 6
  ```

##### array_count_values()

- 统计数组中键值中出现的次数，返回的是一个数组；

##### array_unique()

- 移除数组中重复的值

- ```php
  <?php
  $array1 = array("苹果","梨","苹果","桃","苹果","桃");
  
  $arr = array_unique($array1);
  echo "<pre>";
  print_r($arr);
  output:
  Array
  (
      [0] => 苹果
      [1] => 梨
      [3] => 桃
  )
  ```

##### array_unshift()

- 在数组顶部,追加数据元素,同时返回新数组数量；

##### array_shift()

- 删除数组中第一个数据元素，如果数组第一个数据元素是0或“ ”则不执行；

- 删除成功，返回数组数量，删除失败返回空；

##### array_pop()

- 出栈
- 移除数组中最后一位数据元素
- 移除成功返回最后一位数据元素

##### array_push()

- 往数组末端增加一个或多个元素，返回值，入栈操作后的个数









### 带回调函数的数组函数

##### array_filter()

- **array_filter**( array `$array`[, [callable](https://www.php.net/manual/zh/language.types.callable.php) `$callback`[, int `$flag` = 0]] ) : array
- 数组过滤函数，通过回调函数的方式返回新数组，如果回调函数返回TRUE，数组元素返回到新数组当中，对数组每一个值进行过滤

##### array_walk()

- **array_walk**( array `&$array`, [callable](https://www.php.net/manual/zh/language.types.callable.php) `$callback`[, [mixed](https://www.php.net/manual/zh/language.pseudo-types.php#language.types.mixed) `$userdata` = **NULL**] ) : bool
- 使用用户自定义函数对数组中的每个元素做回调处理
- 不会受到 `array`内部数组指针的影响。**array_walk()**会遍历整个数组而不管指针的位置。

##### array_walk_recersive()

- **array_walk_recursive**( array `&$array`, [callable](https://www.php.net/manual/zh/language.types.callable.php) `$callback`[, [mixed](https://www.php.net/manual/zh/language.pseudo-types.php#language.types.mixed) `$userdata` = **NULL**] ) : bool

- 将用户自定义函数 `callback` 应用到`array` 数组中的每个单元。本函数会递归到更深层的数组中去。
- 典型情况下`callback` 接受两个参数。`array`参数的值作为第一个，键名作为第二个。

##### array_map()

- **array_map**( [callable](https://www.php.net/manual/zh/language.types.callable.php) `$callback`, array `$array1`[, array `$...`] ) : array
- 返回数组，是为 `array1` 每个元素应用 `callback`函数之后的数组。 `callback` 函数形参的数量和传给 **array_map()** 数组数量，两者必须一样

##### array_reduce()

- array_reduce($arrat,'func',1);

- 用回调函数递归的对数组元素进行处理，返回处理后值

- ```php
  function func($c,$i){
  	$c+=$i;
  	return $c;
  }
  ```

  

### 数组排序函数

"a"保存一个索引，"r"反向操作，"u"带一个回调函数，"n"自然排序；

##### sort

 -- 对数组排序(升序)

- **字典排序**
- 常用在微信公众号验证

##### rsort 

-- 对数组逆向排序（降序）

##### asort 

-- 对数组进行排序并保持索引关系（关联数组排序）

##### arsort 

--  对数组进行逆向排序并保持索引关系 

##### usort 

--  使用用户**自定义的比较函数**对数组中的值进行排序，原数组索引不保留

 --返回布尔型和数组

##### uasort 

--  使用用户自定义的比较函数对数组中的值进行排序并保持索引关联

##### ksort 

-- 对数组按照键名排序

krsort

-- 对数组按照键名逆向排序

##### uksort 

--  使用用户自定义的比较函数对数组中的键名进行排序

##### natsort 

--  用“自然排序”算法对数组排序

##### natcasesort

 --  用“自然排序”算法对数组进行不区分大小写字母的排序 

##### array_multisort

 -- 对多个数组或多维数组进行排序（了解）

 --第二个数组的拍讯方式紧跟着第一个数组

##### array_slice 

-- 从数组中取出一段作为其他数组

##### array_splice

 --  把数组中的一部分去掉并用其它值取代 

##### array_intersect 

-- 计算数组的交集

##### file_put_contents();

//文件的写操作 

##### file_get_contents();

//文件的读操作

##### shuffle();

随机对数组排序







### list()&&each()

##### each()

- 获取当前数组指针位置的键和值，并且指针向下移动一位。
- each(var)返回数组中当前的**键／值**，同时返回一个关联和一个索引数组对，并将数组指针向前移动一步，一般会和reset()一起使用（）
  - 在执行 **each()** 之后，数组指针将停留在数组中的下一个单元或者当碰到数组结尾时停留在最后一个单元。如果要再用 each 遍历数组，必须使用 [reset()](https://www.php.net/manual/zh/function.reset.php)。
- reset(var) reset的作用，使数组置零，为下面的each操作的索引可以从零开始，不然each没啥意义
- 因为each(var) 返回的是一个关联数组，但是list()默认接受到的值以索引0开始存储赋给list括号里面的变量，并且在7.00版本之前，list()只能跟数字数组联动，所以跟list()搭配的时候会出现系统警告，但是each()和list()经常搭配使用；

##### reset()

--将数组指针移至首位。

##### list()

- 将一个数组从左到右赋值到list()括号里面对应位置

- list()暂时不能对字符串操作；

- list()只能针对索引数组进行传值，不能针对关联数组进行作用；

- $x = list() 这种赋值会造成不可意料的错误error;

- 因为each会依次拆分键和值，然后构造成新的一个数组，并以索引0开始，这样就可以很好的搭配list()进行使用（打破了不能针对关联数组的作用）；

- 新版本的list()里面不能完全为空，否则报错；

- 从 PHP 7.1.0 开始，**list()** 可以包含显式的键，可赋值到任意表达式。 可以混合使用数字和字符串键。但是不能混合有键和无键不能混用。

- ```php
  <?php
  $data = [
      ["id" => 1, "name" => 'Tom'],
      ["id" => 2, "name" => 'Fred'],
  ];
  foreach ($data as ["id" => $id, "name" => $name]) {
      echo "id: $id, name: $name\n";
  }
  echo PHP_EOL;
  list(1 => $second, 3 => $fourth) = [1, 2, 3, 4];
  echo "$second, $fourth\n";
  
  输出：
  id: 1, name: Tom
  id: 2, name: Fred
  
  2, 4
  
  ```

- ```php
  最好还是直接这样：
         list($v) = $stu;
   		or
          list($k,$v) = each()；//返回键还有值，
  ```


##### end() 

-  将数组的**内部指针**指向最后一个单元 

##### next() 

-  将数组中的内部指针向前移动一位 ，当前数组为空，返回flase

```php
$arr = array("ni","nifa",234);
next($arr);
current($arr);
```

##### prev()

-  将数组的内部指针倒回一位，也就是将数组指针向上移动一位，当前数组为空，返回flase

##### current() 

-  返回数组中的当前单元

key() — 从当前关联数组中取得键名



















































