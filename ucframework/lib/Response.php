<?php

namespace ucframework\lib;

use Nette\Http\Response as HttpResponse;

class Response extends HttpResponse
{

    private static $_instance;

    private function __construct()
    {
        
    }

    /**
     * 
     * @return \ucframework\lib\Response
     */
    public static function getInstance()
    {
        if (!(self::$_instance instanceof self))
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

}
