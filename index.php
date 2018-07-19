<?php
//定义应用目录
define("APPLICATION_PATH", dirname(__FILE__));
//导入配置文件
$app = new Yaf_Application(APPLICATION_PATH."/conf/application.ini");
//运行程序
$app
    ->bootstrap()
    ->run();