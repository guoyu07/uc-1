<?php

namespace ucframework;

class View
{

    public $_assign = [];

    public function fetch($template)
    {
        extract($this->_assign, EXTR_SKIP);
        ob_start();
        include $template;
        $contents = ob_get_contents();
        ob_end_clean();
        $this->clearAssign();
        return $contents;
    }

    private function clearAssign()
    {
        $this->_assign = [];
    }

}
