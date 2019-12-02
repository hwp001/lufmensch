# TP5.1

### 类

##### container

- 容器类

##### controller

- 控制类

### 关键字

##### use

- 导入一个空间

- 导入一个类
  
  - 在MVC模式中一般文件名和类名是一致的
  
- [use详细用法](https://blog.csdn.net/iteye_17658/article/details/82681263)

  - ```
    use +  类    导入全局类
    use + 命名空间 + 类  导入具体类
    ```

    

##### namespace

- 可以认为定义一个空间域
- 具有唯一性
- [细节](https://blog.csdn.net/qq_38378384/article/details/79517898)
- 存在命名空间的时候
  - 完整类名：命名空间+类名
  - 设计类调用的时候，   完整类名：'\\' +命名空间+类名

### 语义

##### 闭包

- 可以看成只含有一个方法的当前类

##### 容器与依赖注入

- 1、任何的URL访问，最终都是定位到**控制器**，由控制器中的某一具体方法去执行

  2、一个控制器对应着一个类，如果这些类需要进行统一管理，怎么办?

  容器来进行管理，该可以将类的实例（对象）作为一个参数，传递给类方法，自动触发依赖注入

  3、URL访问：通过GET方式将数据传到控制器指定的方法中，但是只能传字符串，数值

  - ![](C:\Users\Administrator\Desktop\学习资料\taskNote\md\image\url访问.png)

  4、如果要传一个对象到当前方法中？怎么办

  5、依赖注入：解决了向量中的方法传入参数为对象的问题，参数中自动将类实例化为对象

- ```php
  <?php
  namespace app\common;
  
  class Temp
  {
  	private $name;
  	public function __construct($name = 'Peter')
  	{
  		$this->name = $name;
  	}
  
  	public function setName($name)
  	{
  		$this->name = $name;
  	}
  
  	public function getName()
  	{
  		return '方法是：'.__METHOD__.'当前属性：'.$this->name;
  	}
  
  }
  
  
  
  <?php
  namespace app\index\controller;
  
  /**
   * 容器与依赖注入的原理
   * 1、任何的URL访问，最终都是定位到控制器，由控制器中的某一具体方法去执行
   * 2、一个控制器对应着一个类，如果这些类需要进行统一管理，怎么办?
   * 容器来进行管理，该可以将类的实例（对象）作为一个参数，传递给类方法，自动触发依赖注入
   * URL访问：通过GET方式将数据传到控制器指定的方法中，但是只能传字符串，数值
   * 如果要传一个对象到当前方法中？怎么办
   * 依赖注入：解决了向量中的方法传对s象的问题
   */
  
  class User
  {
  	public function get($name = "Peter")
  	{ 
  		return 'hello'.$name; 
  	}
  
  	/**
  	 * 命名空间+类名 才算是一个完整的类名
  	 * '\' 从一个 ’根路径‘开始 
  	 * \app\common\Temp  当一个变量进行一个约束的时候，就会自动将类实例为一个对象，自动触发依赖注入 
  	 * \app\common\Temp $temp  等价于 $temp = new \app\common\Temp
  	 * 	 	  
  	 */ 
  	public function getMethod(\app\common\Temp $temp)
  	{
  		$temp->setName('PHP中文网');
  		return $temp->getName();
  	}
  }
  
  ```

###### 容器

- 将类绑定到容器里面

  - 

  ```php
  	public function bindClass()
  	{
  		//把一个类放到容器中；相当于注册到容器中
  		\think\Container::set('temp','\app\common\Temp');
  
  		//使用助手函数 将一个类绑定到容器
  		// bind('temp','\app\common\Temp');
  		// //使用助手函数，同下
  		// $temp = app('temp',['name'=>'Peter_zhu']);
  
  		//将容器中的类实例化并取出来用：实例化同时调用构造器进行初始化
  		//第一个参数类的别名，初始化参数赋值
  		$temp = \think\Container::get('temp',['name'=>'Peter_zhu']);
  		return $temp->getName();
  	}
  ```

- 将闭包绑定到容器里面

  - ```
    
    	/**
      	 * 将闭包绑定到容器里面
      	 */
      	public function bindClouser()
      	{
      		//把一个闭包放到容器中；相当于注册到容器中
      		//闭包：可以看成一个有别名的匿名函数
      		\think\Container::set('demo',function($domain){
      			return 'php中文网的域名是：'.$domain;
      		});
      		//第一个参数为闭包名，将入参变量作为一个键
      		return \think\Container::get('demo',['domain'=>'www.php.com']);
      	}
      
    ```

###### 依赖注入

- 在参数中，将类实例化为参


##### 控制器

- 正常情况下，控制器不依赖于父类Controller.php
 * 推荐继承父类，可以很方便的使用在父类封装好的一些方法和属性
 * Controller.php 没有静态代理
 * 控制器中的输出，字符串全部用return 返回，不用echo
 * 如果输出的复杂类型，我们可以用dump()函数
 * 默认输出的格式为html,可以指定其他的格式，json、xml
 * dump => echo "<pre>";print_r();

##### 静态代理

- 门面类Facade

  - 将所有的动态方法变为静态方法

- 自定义静态代理需要继承门面类Facade

  - ```php
    <?php
    /**
     * Created by PhpStorm.
     * User: hwpoo
     * Date: 2019/9/28
     * Time: 10:11
     */
    
    namespace app\facade;
    use think\Facade;
    //静态代理的类名最好和需要静态代理的类名一致
    class User extends Facade  
    {
        /**
         * 获取当前Facade对应类名（或者已经绑定的容器对象标识）
         */
        protected static function getFacadeClass()
        {
            return 'app\validate\User'; //需要静态代理的类
        }
    }
    ```

    

##### 跳转与重定向

###### 跳转

- 在tpl/dispatch_jump.tpl包含着，来实现

- controller内置一个方法
  - true :$this->success('提示语','跳转页面/新的操作')  默认跳转本页面
    - 如果是本模块下的index下的index方法  $this->success('跳转成功','index/index');
    - 如果是跨模块下的index下的index方法   $this->success('跳转成功','admon/index/index');
  - false:$this->error('提示语')  跳转到最后一次成功的地址

###### 重定向

- 响应头告诉浏览器要跳转到那里去，没有中间方法，js实现
- $this->redirect('具体地址或者环境地址')
- redirect()助手函数

##### 空操作与空控制器

###### 空操作

- 空操作是指系统在找不到操作方法的时候，（自己定义）会定义一个空操作(_empty())方法来执行,利用这个机制，我们可以实现错误页面和一些URL的优化

- 空操作不需要任何参数，如果获取当前的操作方法名，直接调用当前对象来获取，你也可以使用

- ```php
  <?php
  namespace app\index\controller;
  
  class City
  {
  	public function _empty($name)
  	{	
  		//把所有城市的操作解析到city方法
  		return $this->showCity($name);
  	}
  	//注意showCity方法 本身是protected方法
  	protected function showCity($name)
  	{
  		//和$name这个城市相关的处理
  		return '当前城市'.$name;
  	}
  }
  ```

###### 空控制器

- 空控制器的概念是指当前系统中找不到指定的控制器名称的时候，系统会尝试定位空控制器（Error），利用这个机制我们可以用来定制错误页面和进行URL优化。

- ```php
  <?php
  namespace app\index\controller;
  use think\Request;
  class Error
  {
  	public function index(Request $request)
  	{
  		//根据当前控制器来判断要执行哪个城市的操作
  		$cityName = $request->controller(); //设置当前控制器
  		return $this->city($cityName);
  	}
  	//注意 city方法 本身是protected方法
  	protected function city($name)
  	{
  		//和$name这个城市相关的处理
  		return '当前城市名'.$name;
  	}
  }
  ```




##### 模型

- 框架中体现mvc设计模式

- 模型下的类名要和数据表一致，要继承Model类

- ```php
  <?php
  namespace app\index\controller;
  use app\index\model\Student;
  
  //模型是和数据表绑定
  //操作是对象 返回是数组
  class Demo6
  {
  	// 单条查询
  	public function get()
  	{
  		// Student == Db::table('Student')
  		dump(Student::get(['stu_id'=>'2']));
  		//Student::get(2)  默认字段名称为 id
  		dump(Student::where('stu_id',2)->find());
  
  	}
  
  	//多条查询
  	public function all()
  	{
  		dump(Student::all());  //打印出所有的字段
  		Student::where('id','in','2,3,4')->select();
  	}
  }
  ```


<<<<<<< HEAD

##### 模板

###### 模板布局

- temple.php开启模板配置文件
  - layout_on   =>打开调用模板文件开关
  - layout_name   =>  模板文件名
- 在view下直接创建以模板文件名命名的文件
  - ![](C:\Users\Administrator\Desktop\学习资料\taskNote\md\image\v1.png)

- 加载顺序  view中  以模板文件名命名的文件-》调用同控制名下方法命名的文件

###### 模板继承

在base.html文件中将header.html头内容还有footer.html底部内容整合在一起，放在view 下面的public公共文件模板，供view其他文件继承调用

- ![](C:\Users\Administrator\Desktop\学习资料\taskNote\md\image\v.png)

- 父模板只有两个标签：include  block

  ```php
  base.html
  {include file="public/header1" /}
  
  {block name="body"}
  主体
  {/block}
  
  {block name="nav"}
  导航
  {/block}
  
  {include file="public/footer1" /}
  ```

- footer1.html

  ```php
  	<h2 style="color:red">我是继承网站底部</h2>
  </body>
  </html>
  ```
=======
##### 模板赋值

- ```php
  <?php
  namespace app\index\controller;
  
  use think\Controller;
  // use think\facade\View;
  
  class Demo7 extends Controller
  {
  	//直接将内容输出到页面，不通过模块
  	public function test1()
  	{
  		$content = '<h3>PHP中文网欢迎你</h3>';
  
  		//Controller内置成员属性
  		// return $this->display($content);
  
  		//$this->view 是Controller里面的一个视图对象		
  		 return $this->view->display($content);   //推荐 直观
  		//用静态代理
  		 // return View::display($content);
  	}
  
  	//使用视图将数据进行输出：fetch();   自动加载有规则模板的文件
  	public function test2()
  	{
  		//模板变量赋值  assign()
  		//1、普通变量
  		$this->view->assign('name','Peter Zhu');
  		$this->view->assign('age',99);
  		//批量赋值
  		$this->view->assign([
  			'sex'=>'男',
  			'salary'=>666
  		]);
  		//array()  第一个参数：数组变量名  通过assign将变量名为goods的数组赋值给模板
  		$this->view->assign('goods',[
  				'id'=>1,
  				'name'=>'手机',
  				'model'=>'meta10',
  				'price'=>999
  		]);
  		//3.object
  		$obj = new \stdClass();
  		$obj->course = 'PHP';
  		$obj->lecture = 'hwp';
  		$this->view->assign('info',$obj);//赋值
  
  		//4、const  在对象中声明常量，只能用define  不能用const  常量属于系统中的一部分
  		define('SITE_NAME', 'PHP中文网');
  
  		//在模板中输出数据
  		//模板默认的目录位于当前模块的view目录,模板文件默认位于当前控制器命名的目录中,文件名要和方法名对应起来
  		return $this->view->fetch();
  	}
  
  	//常用的模板标签
  	public function test3()
  	{
  		
  	}
  }
  ```

  ```php
  {$name}<br>
  {$age}<br>
  {$sex}<br>
  {$salary}<br>
  
  <hr>
  {//数组方式输出}
  {$goods.id}<br>
  {$goods.name}<br>
  {$goods['model']}<br>
  {$goods['price']}<br>
  
  <hr>
  {//对象方式输出}
  {$info->course}<br>
  {$info->lecture}<br>
  
  <hr>
  {//输出常量，第一个字母要大写}
  {$Think.const.SITE_NAME}<br>
  
  <hr>
  {//输出PHP系统常量}
  {$Think.const.PHP_VERSION}<br>
  {$Think.const.PHP_OS}<br>
  
  <hr>
  {//输出php系统变量  $_SERVER['PHP_SELF']}
  {$Think.server.php_self}
  {$Think.server.session_id}
  {$Think.server.get.name}
  {$Think.server.post.name}
  
  <hr>
  {//查看自己定义的配置}
  {// $Think + 文件目录名 + 文件名 + 文件名内容}
  {$Think.config.database.hostname}<br>
  
  <hr>
  {//输出请求变量  param相当于 get+post   可以获取路径，路由器}
  {$Request.get.name}<br>
  {$Request.param.name}<br>
  {//输出 index模块 + 路由器 + 文件}
  {$Request.path}<br>
  {//根路径 入口文件}
  {$Request.root}<br>
  {//返回一个域名 只支持一个参数，若需要多个参数，要设置处理}
  {$Request.root.true}<br>
  {$Request.controller}<br>
  {$Request.action}<br>
  {$Request.host}<br>
  {$Request.ip}<br>
  
  ```

  
>>>>>>> 0b98982838056f5d560f3b70759b8606a504416f

- header1.html

  ```php
  <!DOCTYPE html>
  <html lang="en">
  <head>
  	<meta charset="UTF-8">
  	<title>{$title|default="默认标题"}</title>
  </head>
  <body>
  	<h2 style="color:darkred">我是继承网站头部</h2>
  ```

- 子模板只有两个标签  extend  block

  ```php
  {extend name="public/base" /}
  {block name="body"}
  <h2>我是继承网站实体</h2>
  {/block}
  ```


##### 验证类

- 验证器
  - Validate类里面的方法
  - Controller类里面的validate方法
- 验证规则









### 配置文件操作

```php
<?php
namespace app\admin\controller;
// use think\facade\Config;
class User{

	public function get(){
		//获取全部配置项
		// dump(Config::get());

		//仅获取app下面的配置项，与config/app.php文件对应
		// dump(Config::get('app.'));

		//仅仅获取一级配置项，推荐使用pull()
		// dump(Config::pull('app'));

		//获取二级配置项
		// dump(Config::get('app.app_debug'));

		// //app是默认的一级配置项的前缀，所以可以省略
		// dump(Config::get('app_debug'));
		// dump(Config::get('default_lang'));
		dump(Config::has('app_debug'));
	}

	public function set(){
		//动态设置配置项，静态设置直接更改文件
		//动态设置用的是Config::set();
		
	}
	
	public function helper(){
		//助手函数不依赖Config类的
		// dump(config()); //不传入参数就是获取全部参数

		dump(config('default_module')); //查询默认app里面的参数

		config('?database.username');   //‘？’ 问号代表查询

		config('database.hostname','localhost'); //设置配置项中database.php文件内的username

		dump(config('database.hostname'));
		dump(config('database.username'));
	}

}
```



##### Config::get()  

- ##### 获取配置项

  - 获取app下面的配置项，与config/app.php文件对应

    ```
    Config::get('app.') 
    ```

  - 仅仅获取一级配置项，推荐使用pull()

    ```
    Config::pull('app')
    ```


##### Config::set()  

- 设置配置项中的值

- 两个参数

  - ```
    Config::set('app_debug',true);
    ```

    

##### Config::has()

-  查询配置项是否存在

- 返回是布尔值

#####  助手函数

###### config()

- 无参：获取全部配置项
- 一参：返回该配置项值
- 二参：设置该配置项的值
- config('?database.username');   //  ‘？’   问号代表查询  查询该配置项是否存在

###### bind()

- 将类绑定到容器里面
- bind('temp','\app\common\Temp');

###### app()

- 将容器里面的类实例化为对象并取出

- ```php
  $temp = app('temp',['name'=>'Peter_zhu']);
  ```




### 数据库

###### 数据库连接

- 实例

- ```php
  <?php
  namespace app\index\controller;
  use think\Db;
  
  class Demo4
  {
  	/**
  	 * 1、全局配置，静态配置
  	 * 2、动态配置
  	 * 3、DSN连接
  	 * 格式：数据库类型://用户名：密码@数据库地址：端口号/数据库的名称#字符集
  	 */
  	public function conn2()
  	{
  		return Db::connect([
  			'type'=>'mysql',
  			'hostname'=>'127.0.0.1',
  			'database'=>'hwp',
  			'username'=>'root',
  			'password'=>'hwp'
  		])
  			->table('student')
  			->where('stu_id',4)
  			->value('stu_name');
  	}
  
  	//dsn连接
  	public function conn3()
  	{
  		$dsn = 'mysql://root:hwp@127.0.0.1:3306/hwp#utf8';
  		return Db::connect($dsn)
  			->table('student')
  			->where('stu_id',5)
  			->value('stu_name');
  	}
  }
  ```

  

##### 增删改查

- 实例

- ```php
  <?php
  namespace app\index\controller;
  use think\Db;
  class Demo5
  {
  	/**
  	 * Db类数据库操作的入口类
  	 * 功能：静态调用think\db\Query.php类中的查询方法实现基本操作
  	 * Db::   当使用这个的时候，数据库已经自动的连接完成了
  	 * table():选择数据表
  	 * where():设置查询条件  表达式，数组  字符串（存在着安全隐患）
  	 * 1、单个条件 使用表达式
  	 * 2、对于多个条件使用数组
  	 * find() 返回符合条件的第一条记录，没有就返回NULL
  	 */
  	//单条查询
  	public function find()
  	{
  		$res = 	Db::table('student')
  			->field('stu_name,sex')  //选取指定字段
  			// ->field(['stu_name'=>'名字','sex'=>'性别']);  //可以让指定字段弄别名
  			->where('stu_id','=','2') //等号可以省略 where('stu_id','2')
  			->find(); //如果只是找主键的话，可以直接find(value) 省略掉where
  			dump($res);
  
  	}
  	//多条查询
  	public function select()
  	{
  		//select()返回一个二维数组，没有数据则返回是一个空数据
  	$res = Db::table('student')
  			->field('stu_name,sex')
  			->where([
  				['stu_id','>=','2'],
  				['age','>=','10']
  			])->select();
  			if (empty($res)) {
  				return '没有满足条件的记录';
  			} else {
  				dump($res);
  			}
  	}
  
  	//单条插入
  	public function insert()
  	{
  		//insert()成功返回新增的数量，失败返回false
  		$data = [
  			'stu_id'=>'6',
  			'stu_name'=>'坤亮1',
  			'sex'=>'男',
  			'age'=>'18'
  		];
  		// return Db::table('student')->insert($data,true);
  		return Db::table('student')->data($data)->insert();  //用data前置的方法后，insert后面不能加其他东西
  	}
  
  	//多条插入
  	public function insertAll()
  	{
  		$data = [
  			['stu_id'=>'13','stu_name'=>'李明'],
  			['stu_id'=>'35','stu_name'=>'孙策']			
  		];
  		return Db::table('student')->data($data)->insertAll();
  	}
  
  	//更新操作
  	public function update()
  	{
  			//update()必须要有更新条件
  		// return Db::table('student')
  		// 	->where('stu_id',3)
  		// 	->update(['stu_name'=>'小猫咪']);
  		
  		//如果更新条件是主键的话，可以直接把主键写到更新数组中
  		return Db::table('student')
  			->update(['stu_name'=>'女娲','stu_id'=>5]);
  	}
  
  	//删除操作
  	public function delete()
  	{
  		return Db::table('student')
  			->where('stu_id','=','34')   //where数组之间是“and”关联 ，不是or 
   			->delete(12); //条件是主键，可以直接放进来 否则要where
  	}
  
  	//原生查询
  	public function query()
  	{
  		$sql = "SELECT `stu_name` FROM `student` WHERE `stu_id` IN (3,4,5)";  //这里的字符串不是用单引号括起来，而是``
  		dump(Db::query($sql));
  	}
  
  	//原生写操作 更新、添加、删除
  	public function execute()
  	{
  	 return Db::execute("UPDATE `student` SET `stu_name` = '武松' WHERE `stu_id` = 3");
  	}
  }
  ```

  

### 好文章

##### [学做框架](https://blog.csdn.net/qq_33862644/article/details/79779977)





# 项目总结



### 数据库篇

#### 























