<?php

//namespace Com\Tvcx\Desktop;


class Bootstrap extends Yaf_Bootstrap_Abstract
{
    public function _initAutoload(Yaf_Dispatcher $dispatcher){
//        Loader::import('xxxx/function.php');
//        spl_autoload_register('autoload_modules');
    }

    public function _initSession (Yaf_Dispatcher $dispatcher)
    {
//        Yaf_Session::getInstance()->start();
//        header('content-type:text/html;charset=utf-8');
    }
    public function _initConfig() {
//        $config = Yaf_Application::app()->getConfig();
//        Yaf_Registry::set("config", $config);
    }
    public function _initLogger(Yaf_Dispatcher $dispatcher){
//        \Common\Logger\Helper::$_logpath = APPLICATION_PATH . '/log';
    }
    public function _initDefaultName(Yaf_Dispatcher $dispatcher) {
//        $dispatcher->setDefaultModule("Index")->setDefaultController("Index")->setDefaultAction("index");
    }
    public function _initDb(Yaf_Dispatcher $dispatcher){
//        \Db\Factory::create();
    }
    public function _initRoute(Yaf_Dispatcher $dispatcher) {
//        $router = Yaf_Dispatcher::getInstance()->getRouter();
//        //创建一个路由协议实例
//        $route = new Yaf_Route_Rewrite(
//            'exp/:ident',
//            array(
//                'controller' => 'index',
//                'action' => 'index'
//            )
//        );
//        //使用路由器装载路由协议
//        $router->addRoute('exp', $route);

//        //添加配置中的路由
//        $router->addConfig(Yaf_Registry::get("config")->routes);

    }
    public function _initUtil(Yaf_Dispatcher $dispatcher){
//        Yaf_Loader::import('Common/Util.php');
    }
}