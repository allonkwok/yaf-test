<?php

/**
 * 安全类
 */
class Security
{
    /**
     * 生成加密密码
     * @param string $salt 盐
     * @param string $password 明文密码
     * @return string 加密后密码
     */
    public static function password($salt, $password){
        return md5($salt.$password);
    }
}