[TOC]

# PHP对象

### 	对象的基础知识

-  注意命名方法（驼峰式）
- 不区分大小写，通过参数才能重载（区分java）
- 实例化对象引用类

### 对象的产生

 1、在内存中开辟对象空间

- [堆区和栈区的区别](https://www.cnblogs.com/qiuly/p/8576149.html)

2、执行构造方法

 3、将对象的<u>引用地址</u>返回

 4、$this

- $this指得是当前类的当前对象（常用）

 5、实例

- 引用地址

  ```php
  <?php
  class Ren{
  	public $xingming;
  	public $sengao;
  
  	function suohua(){
  		echo "说话";
  	}
  }
  $lihai = new Ren();
  $lihai->xingming = '李海';
  
  $liming = new Ren();
  $liming->xingming = "李明";
  
  echo $lihai->xingming."<br/>";
  echo $liming->xingming."<br/>";
  
  $li = $lihai;
  $li->xingming = "老李";
  echo $lihai->xingming."<br/>";
  
  output:
      李海
      李明
      老李
        
  ```

- $this的使用

  ```php
  <?php
  class Ren{
  	public $xingming;
  	public $sengao;
  	function __construct($x,$s) {//__contruct析构函数
  		$this->xingming = $x;
  		$this->sengao = $s;
  	}
  	function suohua(){
  		echo "说话";
  	}
  }
  $lihai = new Ren("李海","3m");
  echo $lihai->xingming.$lihai->sengao;
  ```

### 对象的释放、继承、封装、多态

#### 构造函数

 __construct()

- 实例化对象，自动执行内部函数体

#### 析构函数

__destruct()

- 对象执行完毕，php内部回收机制自动将对象回收
- 对象的释放的一瞬间自动调用
  - 做收尾清理工作，数据库关闭连接，文件关闭

#### 释放对象

- 自动释放
  - __destruct()

- 手动释放
  -  unset()
    - 删除对象的引用-砍掉对象引用那条线

#### 类的构建

##### 抽象

- 把一类的共同属性和方法抽象出来，形成类；

##### 封装

- **把实现某一个功能的代码单独的提取出来，放到一个方法或者类中；**

- 把成员方法和成员属性封装到类，隐藏属性和方法，隐藏方法实现的细节，通过public protected private final staic 限定类成员的访问权限，数据被保护在内部，只有通过授权的成员方法才可以操作，竟可能对成员进行封装；

- 将遥控器的控件按钮，怎么换台，调音量这些功能封装到我们的遥控器里面，用户只要会按按钮，得出最后的结果就可以了；

  ```php
  <?php
  
  class tv{
  	private $sengyin;
  	function __construct(){
  		$this->sengyin=20;
  	}
  
  	public function yaokongqi($anniu,$liang=''){
  		switch ($anniu) {
  			case "sengyin":
  				$this->sengyin($liang);
  				break;
  			case 'guandiansi':
  				$this->guandiansi();
  				break;
  			case 'huantai':
  				$this->huantai($liang);
  				break;
  			case 'jingyin':
  				$this->jingyin($liang);
  				break;
  		}
  	}
  
  	private function sengyin($daxiao){
  			// if ($daxiao>0) {
  			// 	echo "音量增多:{$daxiao},当前音量为".($this->sengyin+$daxiao);
  			// } else {
  			// 	echo "音量减少:{$daxiao},当前音量为".($this->sengyin-$daxiao);
  			// }
  		
  	$this->sengyin = $daxiao>0?($this->sengyin+$daxiao):($this->sengyin-$daxiao);
  	echo "当前音量为{$this->sengyin}";
  
  	}
  
  	private function guandiansi(){
  		echo "关电视";
  	}
  
  	private function huantai($pindao){
  		echo "现在是第{$pindao}频道";
  	}
  
  	private function jingyin($zuangtai){
  		$jingyin = $zuangtai==1?"电视静音":"打开声音";
  		echo $jingyin;
  	}
  }
  $tv1 = new tv();
  $tv1->yaokongqi("sengyin",3);
  ```

  

##### 继承

- 可以使一个类继承并拥有另一个已经存在类的成员属性和方法，被继承的类成为父类或子类，继承类为子类，extends关键字实现继承关系；

- 单继承，多实现，把父类的方法完全继承过来；

  - ```php
    class arc{
    	function del($id){
    		echo "删除文章ID为{$id}的文章";
    	}
    	function edit($id){
    		echo "编辑文章";
    	}
    }
    class arcInfo extends arc{
    
    }
    class arcNews extends arc{
    
    }
    
    $info = new arcInfo();
    $info->del(2);
    echo "<hr>";
    $add = new arcNews();
    $add->edit(2);
    output：
       删除文章ID为2的文章
       编辑文章 
    ```

  - 重写父类方法

    ```php
    <?php
    
    class arc{
    	function del($id){
    		echo "删除文章ID为{$id}的文章";
    	}
    	function edit($id){
    		echo "编辑文章";
    	}
    }
    class arcInfo extends arc{
    
    }
    class arcNews extends arc{
    	//重写
    	function edit($id){
    		echo "我要编辑更多额文章";
    	}
    }
    
    $info = new arcInfo();
    $info->del(2);
    echo "<hr>";
    $add = new arcNews();
    $add->edit(2);
    ```

##### 多态

- **架构设计**
- 实现多态
  - 抽象
  - 接口
- 子类继承父类，通过对父类的方法进行重写实现多态

##### [**<u>重载</u>**](https://www.cnblogs.com/ymy124/p/3715430.html)

- 只能通过__call魔术方法来实现
- 重载后子类调用父类方法: parent::父类方法
- 重载只存在一个类中，子类或者父类
- 若要实现重载可以用Trait方法

[**重写**](https://www.cnblogs.com/xuan584521/p/6395217.html)

- 对父类方法进行一个改造，参数个数必须一致
- 对方法体进行变更

#### 修饰符

##### public,protect,private

- 虽然PHP中没有对修饰变量的·关键字做强制性的要求和规定，但从面向对象的特征和设计的考虑，一般使用private和protected关键字来修饰变量，以防止变量在类外被直接修改和调用

- ```php
  <?php
  header("content-type:text/html;charset=utf-8");
  
  class Preson{
  	protected $name = '维克托';
  }
  
  class Preson1 extends Preson{
  	public function showName(){
  		echo '只有正确的调用，我才会出现'."<br/>";
  		echo '我的名字是'.$this->name;
  		echo '<br/>';
  	}
  }
  $preson = new Preson1();
  $preson->showName();
  echo '你调用错了，所以下面不报错算我输';
  $preson->name = '德莱文';
  ```

  

public

- 公有的：本类，子类，外部对象都可以执行

 protect

- 受保护的：     本类，子类，可以执行，外部对象不可以调用

 private 

- 私有的：     只能本类执行，子类与外部对象都不可调用





#### 关键字

##### instanceof 

- 用于确定某一个变量是否属于某一类

- instanceof也可用于确定一个变量是不是实现了某个接口的对象

- ```
  class a{
  }
  $a = new a();
  var_dump(!($a instanceof a));
  ```

  

##### abstact

- **在类与类之间具备同样的行为，或者属性以及方法的时候，但是我们提取出来之后，有些方法和行为意义上一样，实现的过程不一样；**

- 抽象类是指在 class 前加了 abstract 关键字且存在抽象方法（在类方法 function 关键字前加了 abstract 关键字）的类。

- 抽象类不能被直接实例化。抽象类中只定义（或部分实现）子类需要的方法。子类可以通过继承抽象类并通过实现抽象类中的所有抽象方法，使抽象类具体化。

- 如果子类需要实例化，前提是它实现了抽象类中的所有抽象方法。如果子类没有全部实现抽象类中的所有抽象方法，那么该子类也是一个抽象类，必须在 class 前面加上 abstract 关键字，并且不能被实例化。

- ```php
  abstract class tool{
  	abstract function yundung();//可以不要花括号，抽象的话
  }
  class moto extends tool{
  	function yundung(){
  		echo &quot;你好呀&quot;;
  	}
  }
  ```

  

##### interface

- 接口里面不能声明变量，可以使用常量const

- 抽象类提供了具体实现的标准，而接口则是纯粹的模版。接口只定义功能，而不包含实现的内容。接口用关键字 interface 来声明。

-  interface 是完全抽象的，只能声明方法，而且只能声明 public 的方法，不能声明 private 及 protected 的方法，不能定义方法体，也不能声明实例变量 。然而， interface 却可以声明常量。但将常量放在 interface 中违背了其作为接口的作用而存在的宗旨，也混淆了 interface 与类的不同价值。如果的确需要，可以将其放在相应的 abstract class 或 Class 中。

- ```php
  interface usb{
  	function connect();
  	function quit();
  }
   
  class souji implements usb{
  	function connect(){}
  	function quit(){}
  }
  ```


##### final

- 只能用来定义类和定义方法，不能使用final来定义成员属性
- final修饰的类不能被继承
- final修饰的父类方法，子类可以去调用父类的方法，但是子类无法去重写

##### instanceof

- 判断一个类是否是另外一个类的子类

- ```php
  $obj = new arc();
  echo $obj instanceof arc;
  ```


##### const

- 定义常量的关键字，修饰类中的成员或属性
- 类外部获取该属性，通过 类名::常量属性名
- 类内部获取该属性时，通过self::常量属性名
- 不能使用"$"符号，也不能使用对象来访问
- 可以在类中使用，而define一经定义，全局使用

##### static

- 静态成员（修饰属性）
  - 限制外部使用
  - 类外部获取该属性时，通过 类名::属性名称
  - 类内部获取该属性时，通过 self::属性名称
- 静态方法（修饰方法）
  - 类外部调用该方法时，通过 类名::方法名
  - 类内部调用该方法时，通过 self::方法名

- static方法久相当于普通方法一样，但是给方法分了个类，语义化代码；
- 实例化class时，不会重新将static方法声明第二遍
- **静态方法不需要所在类被实例化久可以直接使用**
- 静态方法效率上要比实例化要要，缺点就是不自动进行销毁，而实例化的则可以做销毁
- 静态方法和静态变量创建后始终使用同一块内存，而使用实例的方式会创建多个内存
- 静态方法才能重写静态方法

###### self::（方法名）

- 执行当前类的方法，不论后类怎么重写
- 静态属性要$符号，常量就不用
- self::$obj   self::CC

###### parrent::（方法名）

- 调用父类的方法 （就近原则：：多继承的情况下）

- 适用情况，重写后对父类补充，又不想丢掉父类的功能方法


##### Trait

- Trait是为了类似PHP的单继承语言而准备的一种代码复用机制，突破单继承的限制。

- Trait与class结合来用

  - ```PHP
    <?php
    Trait test1
    {
    	public function test1()
    	{
    		return __METHOD__;
    	}
    }
    Trait test2
    {
    	public function test2()
    	{
    		return __METHOD__;
    	}
    }
    class demo
    {
    	use test1,test2;  //这里的use表示引用Trait类
    	public function hello()
    	{
    		return __METHOD__;
    	}
    }
    
    $obj = new demo();
    echo $obj->test1()."<br>";
    echo $obj->test2()."<br>";
    echo $obj->hello();
    ```

    

- Trait是类不是类，不能够被实例化，但是具有类一样的功能

- Trait的优先级高于class的父类

- class中用use方法继承Trait，并增添规则

  - ```php
    <?php
    Trait test1
    {
    	public function hello()
    	{
    		return __METHOD__;
    	}
    }
    Trait test2
    {
    	public function hello()
    	{
    		return __METHOD__;	
    	}
    }
    //访问两个Trait中重合的方法，在use增加规则
    class demo
    {
    	use test1,test2  //use增加一条规则
    	{   //这里的 test1::hello 意思：test1里面的hello方法，不对成员属性适用，只限于use增添规则说明
    		test1::hello insteadof test2; //test1 hello方法 替代test2
    		test2::hello as Demo2Hello;   //test2 hello 别名 Demo2Hello
    	} 
    
    }
    
    $obj = new demo();
    echo $obj->hello()."<br>";
    echo $obj->Demo2Hello();
    
    ```
    
    

#### 魔术常量

##### __CLASS__

- 返回该类被定义时的名字（区分大小写）。

##### __LINE__

- __LINE__ 的值就依赖于它在脚本中所处的行来决定

##### __FILE__

- 文件的完整路径和文件名。如果用在被包含文件中，则返回被包含的文件名。

##### __DIR__

- 文件所在的目录。如果用在被包括文件中，则返回被包括的文件所在的目录。

- 它等价于 dirname(__FILE__)。除非是根目录，否则目录中名不包括末尾的斜杠。（PHP 5.3.0中新增）

##### __FUNCTION__

- 函数名称（PHP 4.3.0 新加）。自 PHP 5 起本常量返回该函数被定义时的名字（区分大小写）。

#####   __TRAIT__

- Trait 的名字（PHP 5.4.0 新加）。自 PHP 5.4.0 起，PHP 实现了代码复用的一个方法，称为 traits。

  Trait 名包括其被声明的作用区域（例如 Foo\Bar）。

#####   __METHOD__

-   类的方法名（PHP 5.0.0 新加）。返回该方法被定义时的名字（区分大小写）。


- 提示：__FUNCTION__仅返回函数名，__METHOD__返回类名和函数名


##### __NAMESPACE__

- 当前命名空间的名称（区分大小写）。此常量是在编译时定义的（PHP 5.3.0 新增）。

#### 魔术方法

PHP中把以两个下划线__开头的方法称为魔术方法(Magic methods)

##### __construct()

- 类的构造函数

##### __destruct()

- 类的析构函数

##### __call()

- 为了避免要调用的方法不存在时产生错误，我们使用魔术方法__call()来避免。
- 如果没有__call()魔术方法，直接在外面调没有定义的go()方法会报错。
- __call()方法的存在，让外面不会因为没有定义的方法而抛出错误，程序会正常的执行下去。

##### __callStatic()

- 有了__callStatic()，当发现调用的静态方法不存在时，会自动调用这个魔术方法。程序不会报错。
- 参数有2个(未定义方法名，参数【可以是数组】)

##### __get()

- 在类外部访问私有或受保护的成员属性时自动调用

- __get()方法必须有一个参数，返回值可有可无。

- 有一个参数，参数传入你要获取的成员属性的名称，返回获取的属性值。如果成员属性不封装成私有的，对象本身就不会去自动调用这个方法。

- 实例：

  ```php
  <?php
  class study{
  	private $name = "王五";
  
  	 function __get($varName){
  		echo $this->$varName;
  	}	
  }
  $lisi = new study();
  $lisi->name;
  ```

  

##### __set()

- 在类外部设置私有的或受保护的成员属性时自动调用

- 对私有的受保护的成员进行赋值操作

- __set()方法必须有两个参数，返回值可有可无

-  为对象内私有成员属性设置值的，有两个参数，第一个参数为设置值的属性名，第二个参数是要给属性设置的值。

- 常用：设置权限让外部实例化变量可以对内部私有化对象进行更改；

- 实例：

  ```php
  <?php
  class study{
  	private $name;
  
  	 function __set($k, $v){
  		echo "变量 ".$k." 的值为 "."$v";
  		$this->$k = $v;
  		
  	}	
  }
  $lisi = new study();
  $lisi->name="王五";
  ```

  

##### __isset()

- __isset()方法是类外部用来检测私有或受保护的成员属性是否存在

- 在外部直接用isset()和empty()方法检测类的私有属性是检测不到的，只有在类中加了魔术方法__isset()，才能在外部使用isset()方法检测到。

- 实例

  ```php
  function __isset($var){
  	$array = array("name","age");
  	if (in_array($var, $array))
  			return isset($this->$var);
  }
  $lisi = new hdw(---);
  var_dump(isset($lisi->name));
  ```

  

##### __unset()

- 类外部使用unset方法对私有的或受保护的成员属性进行销毁的一瞬间调用
-  unset()方法删除不了类的私有属性，需要在类里面使用魔术方法__unset().

##### __sleep()

- 执行serialize()时，先会调用这个函数

- __sleep():过滤掉在对象串行化过程中**不需要留下的成员属性**

- 在程序执行前，serialize() 函数会首先检查是否存在一个魔术方法 __sleep.如果存在，__sleep()方法会先被调用， 然后才执行串行化（序列化）操作。

- 这个功能可以用于清理对象，并返回一个包含对象中所有变量名称的数组。如果该方法不返回任何内容，则NULL被序列化，导致 一个E_NOTICE错误。

- 【注】当一个对象被串行化,PHP会调用__sleep方法(如果存在的话)，如果没有__sleep方法,PHP将保存所有属性。

- ```php
  <?php
  class user {
      public $name;
      public $id;
      function __construct() {  
          $this->id = uniqid();
       //uniqid() 函数基于以微秒计的当前时间，生成一个唯一的 ID。
      }   
      function __sleep() { //返回需要序列化的成员属性。      
          return(array('name'));
      }
   
   } 
  $u = new user(); 
  $u->name = "Leo"; 
   
  $s = serialize($u); //id属性被抛弃，只序列化name属性。
  print_r($s); //O:4:"user":1:{s:4:"name";s:3:"Leo";}
  ?>
  ```

##### __wakeup()

- 执行unserialize()时，先会调用这个函数

- __wakeup():经常用在反序列化操作中，例如重新建立数据库连接，或执行其它初始化操作。

- 当反串行化一个User对象，__wakeup方法建立id属性的新值

  **注：**

- 在反串行化一个对象时,PHP 会调用__wakeup方法(如果存在)。

- 这两个方法都不接受参数. __sleep方法必须返回一个数组,包含需要串行化的属性. PHP会抛弃其它属性的值.

**问题**

1、当序列化时__sleep()方法没有出现时，反序列化时__wakeup()方法存在可以吗？有什么用？

答案：可以存在，__sleep()不存在，PHP默认的把所有属性都序列化保存。而在反序列化时__wakeup()存在，依然会先执行，进行赋值或初始化操作。

##### __toString()

- 在外部echo对象的时候自动调用

- 快速输出对象的内容，返回一个字符串类型的内容

- 当你想打印对象的时候，这个方法就会被自动调用。

  参数：无，返回值：必须有。

##### __invoke()

- 把对象以函数的方式被调用的时候，invoke方法就会被自动调用

##### __set_state()

- 调用var_export()导出类时，此静态方法会被调用。

##### __clone()

 clone

- 深拷贝与浅拷贝

  对象复制存在两种形式：浅拷贝，深拷贝

  **浅拷贝**：变量之间是地址传递的。地址上是一个值，大家共享这个值。

  **深拷贝**：把变量值复制一份，然后再传递给另一个变量。变量之间是值传递的，

  **使用关键字**clone ,****就能完成深拷贝。而****PHP对象****默认的是浅拷贝

- __clone()这个魔术方法会在使用clone关键字的时候自动调用。

- 【注】参数：无，返回值：不需要。

##### __autoload()

- 只有一个参数$classname

- 只要当系统找不到类的时候自动载入，系统自动载入$classname

- ```php
  <?php
  function __autoload($classname) {
  	if (substr($classname, -6) == 'Action') {
  		include './action/'.$classname.'.php';
  	}elseif($classname == 'db') {
  		include '../libs/common/db.php';
  	}elseif($classname == 'Action'){
  		include '../libs/common/Action.php'
  	}
  }
  ```

  

##### __debugInfo()

- 打印所需调试信息

#### 对象方法

##### get_class_method()

- 获得这个类名有哪些方法
- 传入的参数，类名或者是实例化对象
- 常用场合：权限操作

##### get_class()

- 一个参数，对象名

- 可以获得当前类名，区分大小写  

- 外部需要对象名，若在方法内调用可以省略；

- ```php
  <?php
  class ren{
  	function _getclass(){
  		return get_class();
  	}
  }
  $lisi = new ren();
  echo get_class($lisi)."<hr/>";
  echo $lisi->_getclass(); 
  ```

##### get_class_vars()

- 获取对象的所有属性（公有）

##### get_declared_classes()

- 以数组形式返回当前脚本中定义的类，包含引入脚本内的类

##### get_declared_interfaces()

- 以数组形式返回当前脚本中的接口，包含引入脚本的接口

##### spl_autoload_register()

- spl_autoload_register(array(类名，函数方法));
- __autoloade()无效(权限较低)，默认spl_autoload_register()

##### *serialize()

- 串行化函数
- 对象转化为二进制的字符串，来串行化一个对象
- 把类实例化出的对象转化成字符串的过程返回字符串，此字符串包含了表示 value 的字节流，可以存储于任何地方。

##### *unserialize ()

- 反串行化函数
- 反串行化一个对象，将二进制字符串转化为对象
- 还原已经序列化的对象。

##### method_exists()

- 两个参数，（对象或类名，方法名）
- 判断方法，对象是否存在

##### property_exists()

- 两个参数，（对象或类名，属性名）
- 判断在对象或类中是否有该属性

##### is_subclass_of()

- 两个参数  （对象或类，对象或类）
- 判断一个类是否另一个类的父类

#### 操作符

###### ::

- 相比伪变量$this只能在内部使用来说更为强大。操作符"::"，可以没有任何声明任何实例的情况下访问类中的成员方法和成员变量

  - 通用语法：  关键字::变量名/常量名/方法名

  - parent:可以调用父类中的静态成员和变量；

  - self: 可以调用当前类中的静态成员和常量；

  - 类名:可以调用本类中的变量、常量和方法；

  - ```php
    <?php
    header("content-type:text/html;charset=utf-8");
    class Hero{
    	const CHARACTER = '奥利安娜';
    	function __construct(){
    		echo '五楼要玩中单'.Hero::CHARACTER.'不给就送';
    		echo '<br/>';
    	}
    }
    class I_Hero extends Hero{
    	const ROLE = '亚索';
    	function __construct(){
    		parent::__construct();
    		echo '4楼中单'.self::ROLE.'贼溜';
    	}
    }
    $gamer = new I_Hero();
    ```

- static::$instance     

  - 表示后期延迟绑定
  - 不仅仅表示当前类的这个$instance 也可能表示继承的子类的$instance

#### 模式

##### 单例模式

- 使某个类的对象仅允许创建一个
- 某些应用程序资源是独占的，因为有且只有一个此类型的资源。比如，数据库的连接的独占。希望在应用程序中共享数据库连接，因为在保持连接打开或关闭时，它是一种开销，在获取单个页面的过程中更是如此。
- 比如咱们连接数据库时，如果不使用单例模式，多个地方都对数据类进行了实例化，那么这样会造能很多资源浪费，为了解决这问题，对于数据库类我们只需要实例化一次，后面再次调用它是如果已经实例化，那就直接返回。

##### 工厂模式

- 工厂模式 是一种类，它具有为您创建对象的某些方法。您可以使用工厂类创建对象，而不直接使用 new。这样，如果您想要更改所创建的对象类型，只需更改该工厂即可。使用该工厂的所有代码会自动更改。

- ```php
  <?php
  //测试1
  class a
  {
  	public static function test()
  	{
  		echo "a";
  	}
  }
  //测试2
  class b
  {
  	public static function test()
  	{
  		echo "b";
  	}
  }
  
  //工厂模式
  class Factory
  {
  	public static function set($classname)
  	{
  		return new $classname(); //返回一个实例化对象
  	}
  }
  
  $test1 = Factory::set('a');
  $test1::test();
  echo "<hr>";
  $test1 = Factory::set('b');
  $test1::test();
  
  ```

  

##### 注册树模式

- 主要用来解决全局共享和交换对象
- 注册树模式当然也叫注册模式，注册器模式。之所以我在这里矫情一下它的名称，是因为我感觉注册树这个名称更容易让人理解。注册树模式通过将对象实例注册到一棵全局的对象树上，需要的时候从对象树上采摘的模式设计方法。

###### demo

结合单例模式，工厂模式，注册树模式的用法

```php
<?php
//单例模式  对象唯一
class Site
{
	public $siteName;
	protected static $instance = null; //存放实例
	//禁用构造器
	private function __construct($siteName)
	{
		$this->siteName = $siteName;
	}
	public static function getInstance($siteName='PHP中文网')
	{
		if (!self::$instance instanceof self) {
			self::$instance = new self($siteName);//存放唯一的实例化对象
		}
		return self::$instance;
	}
}

//工厂模式
class Factory
{
	public static function produce($input)
	{
		return Site::getInstance($input);
	}
}

//对象注册树
//1、set将对象挂在树上
//2、get将对象从树上摘下来
//3、_unset将对象销毁
class Register
{	//创造树
	public static $objects = [];

	public static function set($alias,$object)
	{
		self::$objects[$alias] = $object;
	}

	public static function get($alias)
	{
		return self::$objects[$alias];
	}

	public static function _unset($alias){
		unset(self::$objects[$alias]);
	}
}


Register::set('ni',Factory::produce('wwww.bon'));
var_dump(Register::get('ni'));
Register::set('hao',Factory::produce('fafafja'));
var_dump(Register::get('hao'));
```
















#####    



