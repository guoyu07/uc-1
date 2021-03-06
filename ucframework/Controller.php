<?php

namespace ucframework;

use ucframework\lib\Request;

class Controller
{

    private $_view;

    public function __construct()
    {
        $this->_view = new View();
    }

    private $_assign = [];

    public function assign($name, $value = '')
    {
        $this->_assign[$name] = $value == '' ? $name : $value;
    }

    public function fetch($template = '')
    {
        $this->_view->fetch($template, $this->_assign);
    }

    public function success()
    {
        if (Request::getInstance()->isAjax())
        {
            
        } else
        {
            
        }
    }

}
