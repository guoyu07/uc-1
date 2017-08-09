<?php

namespace ucframework;

use ucframework\lib\Config;

class View
{

    public function fetch($template='', $assign)
    {
        extract($assign, EXTR_SKIP);
        ob_start();
        include $this->getTemplatePath($template);
        $contents = ob_get_contents();
        ob_end_clean();
        echo $contents;
    }

    public function getTemplatePath($template='')
    {

        $config = Config::getInstance()->get('config');
        if ($template == '')
        {
            $template = strtolower(MODULE_NAME) . '/' . strtolower(CONTROLLER_NAME) . '/' . strtolower(ACTION_NAME);
        }
        if (!file_exists($template))
        {
            $template = APP_PATH . 'uc/template/' . $config['template']['theme'] . '/' . $template . '.php';
        }
        return $template;
    }

}
