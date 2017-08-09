<?php

/*
 * 入口文件
 */

namespace ucframework;

use Whoops\Run;
use ucframework\lib\Router;
use Whoops\Handler\PrettyPageHandler;

defined('DS') or define('DS', DIRECTORY_SEPARATOR);
defined('APP_PATH') or define('APP_PATH', dirname($_SERVER['SCRIPT_FILENAME']) . DS);

class Bootstrap
{

    /**
     * 是否开启调试模式
     */
    private static function isOpenDebug()
    {
        if (defined('DEBUG') && DEBUG == TRUE)
        {
            $whoops = new Run();
            $whoops->pushHandler(new PrettyPageHandler);
            $whoops->register();
        }
    }

    public static function run()
    {
        self::isOpenDebug();
        
        DatabaseManage::register();
        $router = Router::getInstance();
        $actions = $router->matchUrl();
        define('MODULE_NAME', $actions[0]);
        define('CONTROLLER_NAME', $actions[1]);
        define('ACTION_NAME', $actions[2]);
        $controller = '\\app\\' . MODULE_NAME . '\\controller\\' . ucfirst(CONTROLLER_NAME);
        $ctrObject = new $controller();
        $methor = ACTION_NAME;
        $ctrObject->$methor();
    }

}
