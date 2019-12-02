##### 字符串正则篇

###### 1、preg_match()

执行匹配正则表达式（括号内表示可选的，括号外表示必选的）

```php
 preg_match ( string $pattern , string $subject [, array &$matches [, int $flags = 0 [, int $offset = 0 ]]] ) : int
```

解释：参数

-  `pattern`

  ​                要搜索的模式，字符串类型。             

-  `subject`

  ​                输入字符串。             

-  `matches`

  ​            如果提供了参数`matches`，它将被填充为搜索结果。       $matches[0]将包含完整模式匹配到的文本， $matches[1]       将包含第一个捕获子组匹配到的文本，以此类推。             

-  `flags`

  `flags`可以被设置为以下标记值：

    **PREG_OFFSET_CAPTURE**                                 

  ​			 如果传递了这个标记，对于每一个出现的匹配返回时会附加字符串偏移量(相对于目标字符串的)。           注意：这会改变填充到`matches`参数的数组，使其每个元素成为一个由           第*0*个元素是匹配到的字符串，第*1*个元素是该匹配字符串           在目标字符串`subject`中的偏移量。            

```php
<?php
preg_match('/(foo)(bar)(baz)/', 'foobarbaz', $matches, PREG_OFFSET_CAPTURE);
print_r($matches);
?>
```

输出：

```
Array
(
    [0] => Array
        (
            [0] => foobarbaz
            [1] => 0
        )

    [1] => Array
        (
            [0] => foo
            [1] => 0
        )

    [2] => Array
        (
            [0] => bar
            [1] => 3
        )

    [3] => Array
        (
            [0] => baz
            [1] => 6
        )

)
```

**常规用法**

- 

```php
Example #1 查找文本字符串"php"
<?php
//模式分隔符后的"i"标记这是一个大小写不敏感的搜索
if (preg_match("/php/i", "PHP is the web scripting language of choice.")) {
    echo "A match was found.";
} else {
    echo "A match was not found.";
}
?>
```

- ```php
  /*
  	模式中的\b标志一个单词边界，所以只有独立的单词“web”会被匹配，而不会匹配单词的部分内容，比如“webbing”或"cobweb"
   */
  
  if (preg_match("/\bweb\b/i", "PHP is the web scription language of choice.")) {
  	echo "A match was found.";
  } else {
  	echo "A match was not found.";
  }
  echo "<br>";
  if (preg_match("/\bweb\b/i", "PHP is the website scription language of choice.")) {
  	echo "A match was found.";
  } else {
  	echo "A match was not found.";
  }
  ```

  - ```php
    //从URL中获取主机名称  ?:非捕获分组，捕获的值不会保存下来
    //$matches[0] 将包含完整模式匹配到的文本，
    //$matches[1] 将包含第一个捕获子组匹配到的文本
    preg_match('@^(?:http://)?([^/]+)@i', "http://www.php.net/index.html",$matches);
    $host = $matches[1];
    echo "$host";
    echo "<br>";
    print_r($matches);
    
    //获取主机名称的后面两部分
    preg_match('/[^.]+\.[^.]+$/', $host, $matches);
    echo "<hr>";
    print_r($matches);
    echo "<br>";
    echo "domain name is: {$matches[0]}\n";
    ```

  - ```php
    //使用命名子组
    //为了后向兼容，上面的方式是推荐写法
    //？P<name> 将匹配到的"xxxx"，放在以name为组名的数组里面去
    $str = 'foobar: 2008';
    preg_match('/(?P<name>\w+): (?P<digit>\d+)/', $str, $matches);
    var_dump($matches);
    ```

    

































