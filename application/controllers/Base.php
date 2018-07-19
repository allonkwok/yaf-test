<?php

class BaseController extends Yaf_Controller_Abstract
{
    protected function request($key, $default=null, $type=null){
        if($type=='get'){
            $result = isset($_GET[$key]) ? htmlspecialchars(trim($_GET[$key])) : null;
        }elseif ($type=='post'){
            $result = isset($_POST[$key]) ? htmlspecialchars(trim($_POST[$key])) : null;
        }else{
            $result = isset($_REQUEST[$key]) ? htmlspecialchars(trim($_REQUEST[$key])) : null;
        }
        if($default!=null && $result==null){
            $result = $default;
        }
        return $result;
    }

    protected function get($key, $default=null){
        return $this->request($key, $default, 'get');
    }

    protected function post($key, $default=null){
        return $this->request($key, $default, 'post');
    }

    protected function response($code, $message, $data=null){
        $result = array(
            'code' => $code,
            'message' => $message,
        );
        if($data!=null){
            $result['data'] = $data;
        }
        return json_encode($result);
    }
}