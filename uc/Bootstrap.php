<?php

/*
 * 入口文件
 */

namespace uc;

use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;

class Bootstrap
{

    /**
     * 是否开启调试模式
     */
    private static function isopendebug()
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
        self::isopendebug();
        
    }

}
