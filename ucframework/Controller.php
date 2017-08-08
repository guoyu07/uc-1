<?php

namespace ucframework;

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
        //MODULE_NAME.'/'.
        $this->_view->fetch('');
    }
    
    

}
