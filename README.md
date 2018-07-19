####运行环境php.ini配置
<pre>
[yaf]
# 必要配置！！可以在项目中动态动态调整，来适应不同的生产环境
yaf.environ = product 
yaf.library = NULL
yaf.cache_config = 0
yaf.name_suffix = 1
yaf.name_separator = ""
yaf.forward_limit = 5
yaf.use_namespace = 0
yaf.use_spl_autoload = 0
</pre>

>+ **yaf.environ** Yaf将要在INI中读取的节
>+ **yaf.library** 全局类库的目录路径
>+ **yaf.cache_config** 是否缓存配置文件(只针对INI配置文件生效)
>+ **yaf.name_suffix** 类名中关键信息是否是后缀式, 比如UserModel, 而在前缀模式下则是ModelUser
>+ **yaf.name_separator** 前缀和名字之间的分隔符, 默认为空, 也就是UserPlugin
>+ **yaf.forward_limit** forward最大嵌套深度
>+ **yaf.use_namespace** 开启的情况下, Yaf_Application将会变成Yaf\Application
>+ **yaf.use_spl_autoload** 开启的情况下, Yaf在加载不成功的情况下, 会继续让PHP的自动加载函数加载, 从性能考虑, 除非特殊情况, 否则保持这个选项关闭

####项目中application.ini配置
<pre>
[common]
application.directory=APPLICATION_PATH "/application/"
;application.ext php脚本的扩展名，默认值php
;application.bootstrap Bootstrap绝对路径
;application.library 类库的绝对目录地址
;application.baseUri 在路由中需要忽略的路径前缀
;application.dispatcher.defaultModule 默认的模块，默认值index
;application.dispatcher.throwException = 1
;application.dispatcher.catchException = 1
;application.dispatcher.defaultController 默认值index
;application.dispatcher.defaultAction 默认值index
;application.tpl.path 模版路径
;application.view.ext 视图模板扩展名，默认值phtml
;application.modules 声明存在的模块名，默认值Index
;application.system.* 通过这个属性，可以修改yaf的runtime configure 比如application.system.lowcase_path，但是请注意只有PHP_INI_ALL的配置项才可以在这里被修改，此选项从2.2.0开始引入

;自定义路由 顺序很重要
;routes.regex.type= "regex"
;routes.regex.match =
;routes.regex.route.controller = Index
;routes.regex.route.action = action
;routes.regex.map.1 = name
;routes.regex.map.2 = value

;添加一个名为simple的路由协议
;routes.simple.type="simple"
;routes.simple.controller = c
;routes.simple.module = m
;routes.simple.action = a

;添加一个名为supervar的路由协议
;routes.supervar.type = "supervar"
;routes.supervar.varname = r

;添加一个名为rewrite的路由协议
;routes.rewrite.type = "rewrite"
;routes.rewrite.match = "/product/:name/:value"

;product节点继承自common节点
[product:common]


;数据库配置
;#db.$name.type = 数据库类型
;#db.$name.host = 数据库host
;#db.$name.usr = 数据库账号
;#db.$name.pwd = 数据库密码
;#db.$name.dbname = 数据库名称
;#db.$name.charset = 编码格式
</pre>

####自动加载器
>目录映射规则
+ Controller，默认模块下为{项目路径}/controllers/, 否则为{项目路径}/modules/{模块名}/controllers/
+ Model，{项目路径}/models/
+ Plugin，{项目路径}/plugins/

>类加载规则

Yaf规定类名中必须包含路径信息, 也就是以下划线"_"分割的目录信息. Yaf将依照类名中的目录信息, 完成自动加载:

+ 全局类
<pre>
//Yaf将在如下路径寻找类Foo_Dummy_Bar
 {类库路径(php.ini中指定的yaf.library)}/Foo/Dummy/Bar.php
</pre>
+ 本地类
<pre>
//申明, 凡是以Foo和Local开头的类, 都是本地类
$loader = Yaf_Loader::getIgnstance();
$loader->registerLocalNamespace(array("Foo", "Local"));
//Yaf将在如下路径寻找类Foo_Dummy_Bar
{类库路径(conf/application.ini中指定的yaf.library)}/Foo/Dummy/Bar.php
</pre>
+ 手动导入文件
<pre>
Yaf_Loader::import('conf/NetWorkCode.php');
echo NetWorkCode::NETWORK_ERROR;
</pre>

####Bootstrap
+ Bootstrap, 也叫做引导程序. 它是Yaf提供的一个全局配置的入口, 你可以做很多全局自定义的工作。
+ 以_init开头的方法, 都会被依次调用, 而这些方法都可以接受一个Yaf_Dispatcher实例作为参数



####插件，支持的hook
<pre>
//创建插件
class UserPlugin extends Yaf_Plugin_Abstract{
    public function routerStartup(Yaf_Request_Abstract $request,Yaf_Response_Abstract $response){}
    public function routerShutdown(Yaf_Request_Abstract $request,Yaf_Response_Abstract $response){}
}
</pre>
<pre>
//注册插件
class Bootstrap extends Yaf_Bootstrap_Abstract{
    public function _initPlugin(Yaf_Dispatcher $dispatcher) {
        $user = new UserPlugin();
        $dispatcher->registerPlugin($user);
    }
}
</pre>

>+ **routerStartup** 在路由之前触发 | 这个是7个事件中, 最早的一个. 但是一些全局自定的工作, 还是应该放在Bootstrap中去完成
>+ **routerShutdown** 路由结束之后触发 | 此时路由一定正确完成, 否则这个事件不会触发
>+ **dispatchLoopStartup** 分发循环开始之前被触发
>+ **preDispatch** 分发之前触发 | 如果在一个请求处理过程中, 发生了forward, 则这个事件会被触发多次
>+ **posDispatch** 分发结束之后触发 | 此时动作已经执行结束, 视图也已经渲染完成. 和preDispatch类似, 此事件也可能触发多次
>+ **dispatchLoopShutdown** 分发循环结束之后触发 | 此时表示所有的业务逻辑都已经运行完成, 但是响应还没有发送

###YAF路由类型
>+ Yaf_Route_Simple
>+ Yaf_Route_Supervar
>+ Yaf_Route_Static（默认）
>+ Yaf_Route_Map
>+ Yaf_Route_Rewrite
>+ Yaf_Route_Regex

###使用命名空间
>php.ini开启

<pre>
yaf.use_namespace = 1
yaf.use_spl_autoload = 1
</pre>

>定义自动加载器，可以在公用function中

<pre>
function autoload_modules($class){
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    
    //some code

    $file = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'xxxx' . $class . '.php';
    if( file_exists($file) )
        Loader::import($file);
}
</pre>

>然后在Bootstrap中用 spl_autoload_register 自定义加载器

<pre>
use \Yaf\Bootstrap_Abstract;
use \Yaf\Dispatcher;
use \Yaf\Loader;

class Bootstrap extends Bootstrap_Abstract
{
    /**  自动加载器 */
    function _initAutoload(Yaf\Dispatcher $dispatcher)
    {
        Loader::import('xxxx/function.php');
        spl_autoload_register('autoload_modules');
    }
}
</pre>

###异常和错误

application.dispatcher.throwException 打开的情况下 会抛异常，否则会触发错误
<pre>
try{
    //todo
}catch(Yaf_Exception_LoadFailed $e){
    //加载失败
}catch(Yaf_Exception){
    //其他错误
}
</pre>

