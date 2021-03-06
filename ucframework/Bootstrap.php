<?php

/*
 * 入口文件
 */

namespace ucframework;

use Exception;
use Whoops\Run;
use ucframework\lib\Router;
use ucframework\db\DatabaseManage;
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
        $mca = $router->matchUrl();
        if (in_array($mca[0], ['runtime', 'template', 'model', 'components']))
        {
            throw new Exception('连接地址不正确');
        }
        define('MODULE_NAME', $mca[0]);
        define('CONTROLLER_NAME', $mca[1]);
        define('ACTION_NAME', $mca[2]);
        $controller = '\\app\\' . MODULE_NAME . '\\controller\\' . ucfirst(CONTROLLER_NAME);
        $ctrObject = new $controller();
        $methor = ACTION_NAME;
        $ctrObject->$methor();
    }

}
