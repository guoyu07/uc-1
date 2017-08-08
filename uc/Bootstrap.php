<?php

/*
 * 入口文件
 */

namespace uc;

use Whoops\Run;
use ucframework\lib\Router;
use Whoops\Handler\PrettyPageHandler;

define('DS', DIRECTORY_SEPARATOR);

class Bootstrap
{

    /**
     * 是否开启调试模式
     */
    private static function isOpenDebug()
    {
        if (defined('DEBUG') && DEBUG == TRUE)
        {
            $whoops = new Run;
            $whoops->pushHandler(new PrettyPageHandler);
            $whoops->register();
        }
    }

    public static function run()
    {

        self::isOpenDebug();
        $router = new Router();
        $actions = $router->matchUrl();
        dump($actions);
        define('MODULE_NAME', $actions[0]);
        define('CONTROLLER_NAME', $actions[1]);
        define('ACTION_NAME', $actions[2]);
        $controller = '\\uc\\' . MODULE_NAME . '\\controller\\' . ucfirst(CONTROLLER_NAME);
        $ctrObject = new $controller();
        $methor = ACTION_NAME;
        $ctrObject->$methor();
    }

}
