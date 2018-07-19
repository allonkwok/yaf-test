<?php

//namespace Com\Tvcx\Desktop\Controller;


class TestController extends BaseController
{
    public function pageAction(){
        $this->getView()->assign("content", "控制器传输的变量");
    }

    public function apiAction(){
        Yaf_Dispatcher::getInstance()->disableView();
        echo "api action test";
    }

    public function myQueryAction(){

        Yaf_Dispatcher::getInstance()->disableView();

        $user = $this->getRequest()->getQuery("user");

        echo($user);
    }

    public function myPostAction(){

        Yaf_Dispatcher::getInstance()->disableView();

        $user = $this->getRequest()->getPost("user");

        echo($user);
    }

    public function myParamAction(){
        Yaf_Dispatcher::getInstance()->disableView();

        $ask = $this->getRequest()->getParam('ask');
        $answer = $this->getRequest()->getParam('answer');

        echo "您问的问题是:".$ask."<br/>";
        echo "您给的答案是:".$answer."<br/>";
    }

    public function defaultParamAction($ask='kiss', $answer='me'){
        Yaf_Dispatcher::getInstance()->disableView();

        $ask = $this->getRequest()->getParam('ask');
        $answer = $this->getRequest()->getParam('answer');

        echo "您问的问题是:".$ask."<br/>";
        echo "您给的答案是:".$answer."<br/>";
    }

    public function nativeGetAction(){
        Yaf_Dispatcher::getInstance()->disableView();
        $user = $_GET['user'];
        echo $user;
    }

    public function nativePostAction(){
        Yaf_Dispatcher::getInstance()->disableView();
        $user = $_POST['user'];
        echo $user;
    }

    public function baseRequestAction(){
        Yaf_Dispatcher::getInstance()->disableView();
        $user = $this->request('user');
        echo $user;
    }

    public function baseGetAction(){
        Yaf_Dispatcher::getInstance()->disableView();
        $user = $this->get('user');
        echo $user;
    }

    public function basePostAction(){
        Yaf_Dispatcher::getInstance()->disableView();
        $user = $this->post('user');
        echo $user;
    }

}