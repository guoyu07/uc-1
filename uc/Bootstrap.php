<?php

/*
 * 入口文件
 */

namespace uc;

use Whoops\Run;
use Aura\Router\RouterFactory;
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
        $actions = self::Route();
        define('MODULE_NAME', $actions[0]);
        define('CONTROLLER_NAME', $actions[1]);
        define('ACTION_NAME', $actions[2]);
        $controller = '\\uc\\' . MODULE_NAME . '\\controller\\' . ucfirst(CONTROLLER_NAME);
        $ctrObject = new $controller();
        $methor = ACTION_NAME;
        $ctrObject->$methor();
    }

    /**
     * 路由
     */
    public static function Route()
    {
        $router_factory = new RouterFactory;
        $router = $router_factory->newInstance();

        $routerpath = ''; //路由待实现


        if (!$router->match($routerpath))
        {
            return self::parseUrl(); //目前只支持PATHINFO 
        }
    }

    private static function parseUrl()
    {
        if (isset($_SERVER['PATH_INFO']))
        {
            $path = explode('/', trim($_SERVER['PATH_INFO'], '/'));
            $patharrcount = count($path);
            if ($patharrcount < 3)
            {
                
            }
            $i = 0;
            $patharrcount > 3 ?
                            list($actions, $get) = array_chunk($path, 3) :
                            $actions = $path;

            while (isset($get[$i]))
            {
                $_GET[$get[$i]] = isset($get[$i + 1]) ? $get[$i + 1] : '';
                $i += 2;
            }
            return $actions;
        } else
        {
            
        }
    }

}
