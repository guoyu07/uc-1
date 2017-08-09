<?php

namespace ucframework\lib;

class Config
{

    private static $_instance;
    private $_config = [];

    private function __construct()
    {
        $this->_config['config'] = @include APP_PATH . 'uc/config.php';
        $this->_config['database'] = @include APP_PATH . 'uc/database.php';
    }

    /**
     * 
     * @return \ucframework\lib\Config
     */
    public static function getInstance()
    {
        if (!(self::$_instance instanceof self))
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function get($key = '')
    {
        return $key == '' ? $this->_config : $this->_config[$key];
    }

    /**
     * 覆盖__clone()方法，禁止克隆   
     */
    private function __clone()
    {
        
    }

}
