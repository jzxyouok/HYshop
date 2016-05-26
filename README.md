## 常用

* 控制台访问地址 - 后台
http://localhost:63342/HongYu/shop/index.php?m=Admin&c=Index&a=index


* Html 文件格式

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <title></title>
    <link href="{$smarty.const.ADMIN_CSS_URL}bootstrap.min.css" rel="stylesheet">
</head>
<body>



<script src="{$smarty.const.ADMIN_JS_URL}jquery.min.js"></script>
<script src="{$smarty.const.ADMIN_JS_URL}bootstrap.min.js"></script>
</body>
</html>


########################################################################################################################

## 开发常量

* 商城根目录
define("SITE_URL","http://localhost/"); // shop商城根目录      {$Think.const.SITE_URL}

* 缓存地址
define("CACHE_URL",SITE_URL."shop/Runtime/Cache/");   //缓存地址    {$Think.const.CACHE_URL}

* Home前台 css、img、js常量
define("CSS_URL",SITE_URL."shop/Public/Home/css/");   //css    {$Think.const.CSS_URL}
define("IMG_URL",SITE_URL."shop/Public/Home/images/");   //img {$Think.const.IMG_URL}
define("JS_URL",SITE_URL."shop/Public/Home/js/");   //js       {$Think.const.JS_URL}

* Admin后台 css、img、js常量
define("ADMIN_CSS_URL",SITE_URL."shop/Public/Admin/css/");   //css   {$Think.const.ADMIN_CSS_URL}
define("ADMIN_IMG_URL",SITE_URL."shop/Public/Admin/img/");   //img   {$Think.const.ADMIN_IMG_URL}
define("ADMIN_JS_URL",SITE_URL."shop/Public/Admin/js/");   //js      {$Think.const.ADMIN_JS_URL}

* 商城信息
define("SHOP_NAME","鸿宇多用户商城");   //商城名称    			{$Think.const.SHOP_NAME}
define("SHOP_NAME_JANE","鸿宇");   //商城名称简写   			{$Think.const.SHOP_NAME_JANE}
define("SHOP_TILE","鸿宇多用户商城 - hongyuvip.com");   //商城标题    	{$Think.const.SHOP_TILE}

########################################################################################################################

TinkPHP【控制器访问方法】
    localhost/ThinkPHP/index.php?m=Home&c=Index&a=hello

【路由解析】
    通过url地址get参数找到指定的控制器,并进行对应方法调用请求
    http://网址/index.php?m=模块名称&c=控制器&a=方法
    tp框架url地址可以由一下四种
    1.http://网址/index.php?m=XX&c=XX&a=XX            基本 get 模式
    2.http://网址/index.php/模块/控制器/操作方法       路径模式 pathinfo
    3.http://网址/模块/控制器/操作方法                 rewrite 重写模式
    4.http://网址/index.php?s=/模块/控制器/操作方法    兼容模式
    具体 url 地址模式设置(配置文件ThinkPHP/Conf/convertion.php)
    URL_MODEL = 0/1/2/3 分别代表四种 url 地址模式
    TinkPHP/Shop/Common/Conf/config.php 是我们当前自己项目的配置文件,我们可以通过修改该文件达到配置变量的目录,这个文件在系统运行过程中会覆盖convertion.php的配置变量
    include"convertion.php";
    include"config.php";    后引入的文件要把先引入的文件配置变量给覆盖掉

    我们系统有兼容4中 url 地址模式的使用
    系统有的时候会自动创建 url 地址,它会根据当前模式进行 url 地址创建使用
    U(); 创建 url 地址

    在入口文件 index.php 调整当前模式为开发调试模式:
    // 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
    define('APP_DEBUG',True);

    1.我们学习到了配置变量 (核心配置变量 convertion.php、当前应用配置变量 config.php)
    2.快捷函数 U("模块/控制器/方法") 根据参数创建 url 模式 创建对应的 url 地址
    3.把框架的模式调整为开发调试模式

【开发、生产模式】
    开发调试模式:系统需要加载26个文件 index.php    define('APP_DEBUG',True);
    生产模式:系统只需要加载很少的文件 index.php     define('APP_DEBUG',False);

    观察系统运行过程中生成的日志信息:
    1.做变量配置,convertion.php,config.php
    2.tp框架配置变量:convertion.php   Behavior 行为文件    程序灵活设置
      Behavior(页面显示追踪日志信息) 行为:ThinkPHP/Library/Behavior/ShowPageTraceBehavior.class.php    开启方式:config.php 中配置 'SHOW_PAGE_TRACE' => 'True',

【控制器调用视图 view 模板】
    define('APP_DEBUG',True);   错误信息显示更详细
    控制器和模板的关系
    通常:每个控制标志在 view 目录都会有一个与应控制器标志一样的目录,里边有具体模板文件
         例如 GoodsController.class.php 控制 在 view 目录有 Goods 目录,里边都是 Goods 控制器对应的模板文件

【视图模板与项目进行整合】
    1.引入静态代码
    2.引入css、image、js
      a)    以上3样东西,浏览器需要发送单独的 http 请求
      b)    引入 css 的时候,以 User 控制器标志作为当然目录,显然不行
            <a href="#"><img src="/Shop/Public/img/logo.jpg"/></a>
            以上目录设置不利于后期维护,例如其中的目录有修改,就需要全部修改,有很多重复劳动
            优化好:利用常量把路径给定义好,后期只维护一个常量即可

            //定义css、img、js常量
            define("SITE_URL","http://localhost/");
            define("CSS_URL","Public/css/");   //css
            define("IMG_URL","Public/img/");   //img
            define("JS_URL","Public/js/");   //js
            tp框架默认引擎的常量使用
            <a href="#"><img src="{$Think.const.IMG_URL}logo.jpg"/></a>
    模板与tp框架整合
    1.引入静态代码
    2.引入css、img、js文件
    3.在入口文件地方把css、img、js的路径设置常量
    4.在模板中通过常量获取具体的css、img、js等文件信息
    5.把css样式文件本身的图片路径设置正确(获得图片的相对位置是本身自己css文件)
【url地址大小写设置】
    http://localhost:63342/ThinkPHP/shop/index.php?m=Home&c=Index&a=index
    在config.php里边对url大小写敏感设置
    //url地址大小写不敏感设置
     'URL_CASE_INSENSITIVE'  =>  True,   //True 不区分大小写
     引入文件: include"hello.php";      include("Hello.php");实际都会把指定文件找到 hello.php
     tp框架本身自己做了额外设置: include("hello.php");    include"Hello.php"; 表示需要引入两个不同文件

【空操作和空调控制器使用】
    http://localhost:63342/HYshop/shop/index.php?m=Home&c=Index&a=indexout  //空控制器
    一般网站处于安全考虑不给用户提示任何错误信息
    "空操作"本质意思:一个对象(控制器)调用本身不存在的方法
    在 OOP 里边,对象调用本身不存在方法,处于用户体验比较好的角度考虑,我们可以在类里边制作一个魔术方法:function__call();
    //避免方法被重复在各个控制器中书写,可以把该访问放到父类里面
    function __call($m,$arg){}
    function __call($method,$args) {}
    普通控制器父类的位置:
    //Controller父类:ThinkPHP/Library/Think/Controller.class.php
    class UserController extends Controller{}
    U() 制作url地址的快捷函数
    C() 获得配置变量(convertion.php   config.php)信息
    C(名称,值) 设置配置变量信息
    L() 获得语言变量信息
    E() 给页面输出错误信息
    空操作有两种解决方案
    ①在对应的控制器里边制作一个方法m,mingcheng为"_empty",这个控制器的空操作都会自动执行该方法
    //空操作提示信息
        function _empty(){
            echo "对不起,方法不存在";
        }
    ②给空操作的名称制作一个同名的模板出来,系统会自动调用 //不推荐此方法

【项目分组】
    系统有前台用户操作界面
    系统还有后台供公司内部人员使用维护平台
    两者在使用的过程中就是对"控制器"、"视图模板"、"model模型"的操作
    为了系统开发方便,及代码部署更加合理,在我们的控制器、view视图等前后台文件不要混在一起,要在物理结构上给分开

    Home 目录
        Controller
            GoodsController.class.php
            IndexController.class.php
            UserController.class.php
    Admin 目录
        Controller
            GoodsController.class.php
            IndexController.class.php
            UserController.class.php
    http://localhost/Shop/index.php?m=Home&c=Index&a=index  //访问Home控制器及制定操作
    http://localhost/Shop/index.php?m=Admin&c=Index&a=index //访问Admin分组的控制器和操作方法

【后台登录页面与框架整合】
    http://localhost/Shop/index.php/Admin/Index/index
    控制器:
    ManagerController.class.php
    function login(){}
    为后台静态资源创建常量
    //定义Admin后台 css、img、js常量
    define("ADMIN_CSS_URL","Public/Admin/css/");   //css    {$Think.const.ADMIN_CSS_URL}
    define("ADMIN_IMG_URL","Public/Admin/images/");   //img {$Think.const.ADMIN_IMG_URL}
    define("ADMIN_JS_URL","Public/Admin/js/");   //js       {$Think.const.ADMIN_JS_URL}

【后台字形框架页面搭建】
    控制器: IndexController.class.php
    操作方法: head() left() right() index()
    获得系统常量信息: var_dump(get_defined_constants(true));
    function head(){
        //获得当前系统给我们提供了什么常量可供使用(系统和自定义的)
        //get_defined_constants([true]) true参数会把常量进行自动分组显示 分组查看:查看源码
        var_dump(get_defined_constants(true));
        $this -> display();
    }

    syntax error,unexpected '/'
    错误位置
    FILE: D:\HYshop\ThinkPHP\Library\Think\Dispatcher.class.php 　LINE: 178
    以上错误信息是tp框架给我们封装好的错误信息,我们更喜欢看我们传统的错误信息
    调整文件 ThinkPHP/Library/Think/Think.class.php  32-35行
          // 设定错误和异常处理
          register_shutdown_function('Think\Think::fatalError');
          set_error_handler('Think\Think::appError');
          set_exception_handler('Think\Think::appException');
    把以上三行注释掉,以后看到的错误就是传统的错误信息

    <frameset border="0" framespacing="0" rows="60,*" frameborder="0">
        <frame name="head" src="__CONTROLLER__/head" frameborder="0" noresize="" scrolling="no">
        <frameset cols="220,*">
            <frame name="left" src="__CONTROLLER__/left" frameborder="0" noresize="" >
            <frame name="right" src="__CONTROLLER__/right" frameborder="0" noresize="" >
        </frameset>
    </frameset>
    __CONTROLLER__    //通过"行为"会被自动替换为常量信息
    行为: ThinkPHP/Library/Behavior/ContentReplaceBehavior.class.php 进行的替换

【跨控制器调用】
    一个控制器在执行的时候,可以实例化另外一个控制,并通过对象访问其指定方法。
    跨控制器调用可以节省我们代码的工作量
    例如: 有10个页面,都要显示指定的数据信息。比如我们网站的"会员数目有200万"
    这个信息需要在10个页面都显示
    这个数据是通过 UserController.class.php 里边的方法 number() 给查询出来的
    现在商品列表页面也需要显示200万的会员数目信息,那么原则上就是 GoodsController.class.php 里边也有一个方法 number() 专门获得会员数目
    如果许多页面都需要显示200万的会员数据,则许多控制器都需要有 number() 方法。
    如果大家都能实例化 User 控制器,并调用它的 number() 方法,则会节省许多重复劳动。

    //获得User控制器的 number() 方法返回的信息
    //当前 UserController 会通过自动加载机制引入
    //ThinkPHP/Library/Think/Think.class.php    函数: function autoload();
    //$user = new UserController();
    // var_dump($user);
    //通过快捷函数实例化控制器对象
    //new一个控制器对象给我们返回
    //A([项目://][模块/]控制器标志)
    $user = A("User");
    echo $user -> number();
    echo R("User/number");
    //echo R("Admin/Goods/getMoney"); //跨模块调用(暂不可用)

    快捷函数 A() 文件位置: ThinkPHP/Common/functions.php

    A("[模块/]控制器标志")实例化控制器对象
    R("[模块/]控制器标志/操作方法")    实例化对象同时调用指定方法

【框架执行流程分析】
    tp框架内部代码集成: 面向过程和OOP面向对象
    1.index.php 入口文件
    2.ThinkPHP/ThinkPHP.php
        在php5.3版本以后
        设置常量有两种方式:
        const name = value; 作用域根据当前命名空间决定
        define()    作用域全局
        ①第一了许多常量
        ②引入核心文件Think.class.php
        Think::start();
    3.ThinkPHP/Library/Think/Think.class.php
        static function start()
        ①引入系统核心文件
        ②引入配置文件
        ③如果是生成木事,还会生成common~runtime.php文件
        ④如果是第一次使用系统,还会自动创建对应的应用目录
            App::run();
    4.ThinkPHP/Library/Think/App.class.php
        static function run()
        App::init();
            路由解析
            //路由解析,把模块、控制器、方法赋予变量
            //MODULE_NAME = 模块名称
            //CONTEOLLER_NAME 控制器
            //ACTION_NAME 方法
        App::exec();
            实例化控制器对象
            利用"反射"实现对象调用方法
        利用反射实现对象调用方法:
        class Person{
            function say(){
                return "is me";
            }
            function run($speed,$addr){
            return "is me".$addr."yes!".$speed;
            }
        }
        //$obj = new Person
        //$obj -> say();
        //$obj -> run('10','china');

        利用反射实现对象调用方法
        $tom = new Person;
        $med = new ReflectionMethod($tom,'say');反射方法对象
        echo $med -> invoke($tom);//对象调用方法

        $name =new Person
        $med2 = new ReflectionMethod($name,'run');
        echo $med2 -> invokeArgs($name,array('20','up'));

        内容总结:
        1.创建应用项目
            a)  入口文件 index.php
            b)  应用常量定义 define("CSS_URL",XXX);
            c)  define("APP_DEBUG",true); 调整模式未开发调试模式
            d)  包涵核心程序 ThinkPHP/ThinkPHP.php
        2.控制器和视图创建
            a)  UserController.class.php (命名空间)
            b)  Home/View/User/login.html
            c)  Home/View/User_login.html (在配置文件里边有定义控制器和模板中间的连接符)
            d)  Home/View/User_register.html //     'TMPL_FILE_DEPR'        =>  '/', //模板文件CONTROLLER_NAME与ACTION_NAME之间的分割符
        3.路由解析
            a)  http://网址/index.php?m=XX&c=XX&a=XX             基本 get 模式
            b)  http://网址/index.php/模块/控制器/操作方法       路径模式 pathinfo
            c)  http://网址/模块/控制器/操作方法                 rewrite 重写模式
            d)  http://网址/index.php?s=/模块/控制器/操作方法    兼容模式
            e)  U("控制器/操作方法"); 查看具体url路由解析模式
        4.配置文件(核心、公共、分组模块)及函数库文件
            a)  核心: ThinkPHP/Conf/convertion.php
            b)  公共: shop/Conmmon/Conf/config.php
            c)  分组模块: shop/Home/Conf/config.php
            d)  上述三个配置文件后边的配置变量会覆盖前面的配置变量
            e)  函数库文件:
            f)  核心: ThinkPHP/Conmmon/function.php
            g)  公共: shop/Conmmon/Conmmon/function.php
            h)  分组模块: shop/Home/Conmmon/function.php
        5.模板与tp框架整合
            a)  拷贝模板代码到tp框架view目录
            b)  拷贝css、img、js静态资源到tp指定目录(shop/public)
            c)  在入口文件处把css、img、js路径定义为常量
            d) 在模板中通过常量把静态资源引入{#Think.cont.常量名}
            e)  调整css文件里面的图片路径
            f)  常量使用注意: 在入口文件是先定义常量,再引入核心文件 ThinkPHP.php
        6.空操作和空控制器处理
            a)  空操作: 在控制器中定义方法 function _empty($m,$arg)
            b)  空控制器: 定义控制器EmptyController.class.php
        7.项目分组
            a)  Home 、 Admin 分组
        8.跨控制器调用
            a)  A("[分组模块/]控制器标志") 实例化控制器
            b)  R("[分组模块/]控制器标志/操作方法") 实例化控制器同时直接调用指定方法
            c) new UserController(); 直接实例化指定的控制器
        9.后台"品"字形页面搭建
            a)  head left right
            b)  index(frameset)
            c)  frame 里面 src= 通过独立路由进行请求

数据模型 model 应用
mysql 数据库操作(增、删、改、查)

【连接数据库配置】
    ThinkPHP配置文件: ThinkPHP/Conf/convention.php
    项目自定义配置文件: shop/Common/Conf/config.php
    1.在 config.php 做数据库连接配置
        /* 数据库设置 */
        'DB_TYPE'               =>  'mysql',     // 数据库类型
        'DB_HOST'               =>  'localhost', // 服务器地址
        'DB_NAME'               =>  'root',      // 数据库名
        'DB_USER'               =>  'root',      // 用户名
        'DB_PWD'                =>  '123456',    // 密码
        'DB_PORT'               =>  '3306',      // 端口
        'DB_PREFIX'             =>  'hy_',       // 数据库表前缀
        'DB_PARAMS'          	=>  array(),    // 数据库连接参数
        'DB_DEBUG'  			=>  TRUE,       // 数据库调试模式 开启后可以记录SQL日志
        'DB_FIELDS_CACHE'       =>  true,       // 启用字段缓存
        'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
    2.制作 model 模型
        a)  model 本身就是一个类文件
        b)  数据库中的每个数据表都对应一个 model 模型文件
        c)  最简单的数据 model 模型类
            //shop/Model/GoodsModel.class.php
            //商品数据模型 model
            namespace Model;
            use Think\Model;
            //父类 Model ThinkPHP/Library/Think/Model.class.php
            class GoodsModel extends Model{}
    3.字段缓存设置
        tp框架执行过程中会使用到数据表中的字段信息,通过sql语句可以查询"show colums from table",出于性能考虑,可以把字段缓存,避免每次重复执行sql语句,浪费数据库资源
        //以下字段缓存没有起作用原因: ①如果是调试模式就不起作用 ②False 也不起作用
        'DB_FIELDS_CACHE'       =>  TRUE,       // 启用字段缓存
    4.可以根据情况对当前的 model 模型进行个性化设置
        namespace Model;
        use Think\Model;
        //父类 Model ThinkPHP/Library/Think/Model.class.php
        class QqModel extends Model{
            //定义当前模型操作真实的数据表信息
            protected $tablePrefix      =   'tencent_';   // 数据表前缀
            protected $trueTableName    =   'tencent_qq'; // 实际数据表名（包含表前缀）
        }
    5.在入口文件定义一个调试输出函数
        //制作一个输出调试函数
        function show_bug($msg){
            echo "<pre style='color:red;'>";
            var_dump($msg);
            echo "</pre>";
        }
【实例化 model 的三种方式】
    1.$goods = new \命名空间\GoodsModel();
    2.$goods = D('模型标志');
        a)  $goods = D("Goods");
        b)  该 $goods 是父类 Model 的对象,但是操作的数据表还是 hy_goods
        c)  $obj = D(); 实例化 Model 对象,没有具体操作数据表,与M()方法效果一致    $goods = D();    //object(Think\Model)
    3.$obj = M();
       a)   实例化父类 Model();
       b)   可以直接调用父类 Model 里面的属性,获得数据库相关操作
       c)   自定义 model 就是一个空壳,没有必要实例化自定义 model
       d)   $obj = M('数据表标志); //实例化Model对象,实际操作具体的数据表
       $obj = D(标志);
       $obj = D();
       $obj = M(标志);
       $obj = M();
       D()和M()方法的区别:
           ①前者是 tp3.1.3 里面对 new 操作的简化方法
           ②后者再使用就是实例化 Model 父类
           ③两者都在函数库文件定义 ThinkPHP/Conmmon/function.php
           //实例化model对象
           //$goods = new \Model\GoodsModel();   //object(Model\GoodsModel)
           //$goods = D("Goods");    //object(Think\Model)
           //$goods = D();    //object(Think\Model)
           $goods = M('Goods');    //实例化Model对象,实际操作Goods数据表
           //$goods = M();    //object(Think\Model)
           show_bug($goods);
        注意: 如果没有对应的 model 模型文件类,也可以直接实例化 model 对象进行操作
            D()和M()方法都可以实例化操作一个没有具体 model 模型类文件的数据表
【数据查询】
    select()是数据模型的一个指定方法,可以获得数据表的数据信息,返回一个二维数组信息,当前数据表的全部数据信息
        1.配置smarty
            a)  配置变量信息
                i.  convertion.php
               ii.  Begavior 行为配置变量信息(页面底部日志显示配置、smarty 配置)
              iii.  系统程序里面有一些零散的配置信息
            b)  在 config.php 里面配置 smarty 使用设置
                'TMPL_ENGINE_TYPE'      =>  'Smarty',   //修改模板引擎为 smarty
                模板引擎配置参数位置: ThinkPHP/Conf/convention.php  (不能直接修改,在 config.php 中修改)
        2.具体使用(从 tp 引擎变为 smarty 引擎)
            a)  css 样式如果有{},需要使用{literal}{/literal}标签禁止 smarty 解析
            b)  关键字 $Think 变为 $smarty
            c)  tp 引擎会对关键常量进行替换,例如: __CONTROLLER__  __MODULE__
                smarty 引擎不给替换,需要设置为: {$smarty.const.__CONTROLLER__}
            {foreach $info as $k => $v}<tr><th>{$v.goods_id}</th><td>{$v.goods_name}</td><td>{$v.goods_sn}</td><td>{$v.market_price}</td><td>{$v.goods_number}</td><td>进货</td></tr>{/foreach}
【各种查询条件设置】

    $obj = D(标志);   //创建对象
    $obj -> select();   //查询数据
    select  字段, 字段 from 表名 where 条件 group 字段 having 条件 order 排序 limit 限制条数;
    $obj -> field(字段,字段);   //查询指定字段
    $obj -> table(数据表);     //通过具体数据表查询
    $obj -> where(参数);      //参数就是正常 sql 语句 where 后边的条件信息,("goods_price >100 and goods_name like'鸿宇'")
    $obj -> group(字段);      //根据字段进行分组查询
    $obj -> having(参数条件);      //having 条件设置
    $obj -> order('price desc/asc');   //排序查询 (desc降序/asc升序)
    $obj -> limit([偏移量,]条数);      //限制查询的条数

    sql 语句里面具体的条件设置在 tp 框架 model 模型里面体现为具体的方法操作

    以上方法理论上是父类 Model 的对应方法
    父类 model 具体存在方法: field()     where()     limit()
    还有一些方法在 __call() 自动调用函数里面: table()     group()     order()     having()

        在 __call() 魔术方法里面会判断当前的执行方法是否是一个 method 属性的元素信息,如果存在就会执行
    以上多个方法是同时使用多个进行条件显示 (并且没有顺序要求)
    $obj->limit(5)->field('id,name')->order('price asc')->table('hy_users')->select();
    以上许多方法执行没有顺序要求,许多方法执行后都是把具体的参数赋予到 model 属性 options 里面,最后根据 options 拼装 sql 语句

    function showlist(){
        //实例化 Model 对象
        $goods = D("Goods");

        //获取数据信息
        $info = $goods -> select();

        //$goods = D();
        //$info = $goods -> table('hy_goods') -> select();
        //show_bug($info);

        //输出调试变量信息
        //show_bug($info);
        //foreach($info as $k => $v){
        //    echo $v['goods_name']."<br/>";
        //}


        //价格大于1000元的商品 和 商品名字含有 海 字商品
        //$info = $goods -> where("market_price > 1000 and goods_name like '%海%'") -> select();

        //查询指定字段
        //$info = $goods -> field("goods_id,goods_name") -> select();

        //限制条数
        //$info = $goods -> limit(5,5) ->select();

        //分组查询 group by
        //查询当前商品一共的分组信息
        //通过分组设置可以查询每个分组的商品信息
        //例如: 每个分组下面有多少商品信息
        //      select goods_category_id,count(*) from group by category_id
        //      每个分组下面商品的价格算术和是多少
        //      select category_id,sum(price) from table group by category_id
        //$info = $goods -> field('goods_category_id')-> group('goods_category_id') ->select();

        //排序显示结果 order by market_price desc (desc降序/asc升序)
        //$info = $goods -> order('market_price desc') -> select();

        //把数据 assign 到模板
        $this -> assign('info',$info);
        $this -> display();
    }

【查询数据信息】
    $info = $goods -> where() -> field() -> select();
    select()方法
    1.返回一个二位数组信息
    2.范湖全部数据表信息
    3.给该方法传递参数
        a) select(30) 查询主键值等于30的记录信息
        b) select("10,12,18") 查询主键值在 10、12、18 范围的记录信息
    4. find() 如果我们查询的结果只有一个信息,使用 select() 会返回一个二维数组
       为了使用方便我们会希望返回一个一维数组,这个时候可以使用 find() 方法

【待记录】





【表单验证】
JavaScript
jQuery
在服务器端通过tp框架实现表单验证
用户名、密码、重复密码、邮箱、qq、手机号码、爱好、学历

具体步骤:
1.制作表单
2.表单form数据通过create()方法收集(验证功能要求我们必须通过create()方法收集数据)
3.自定数据model模型类实现具体验证规则








*************************************************
附录：

①SQL数据操作
select()    //查询
add()       //增加
save()      //修改
delete()    //删除

