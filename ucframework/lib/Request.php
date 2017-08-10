<?php

namespace ucframework\lib;

use Nette\Http\Request as NHRequest;

class Request extends NHRequest
{

    private static $_instance;

    private function __construct()
    {
        
    }

    /**
     * 
     * @return \ucframework\lib\Request
     */
    public static function getInstance()
    {
        if (!(self::$_instance instanceof self))
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __clone()
    {
        
    }

}
