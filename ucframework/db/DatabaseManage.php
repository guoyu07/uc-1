<?php

namespace ucframework\db;

use ucframework\lib\Config;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;

class DatabaseManage
{

    public static function register()
    {
        $capsule = new Capsule;
        $capsule->addConnection(Config::getInstance()->get('database'));
        $capsule->setEventDispatcher(new Dispatcher(new Container));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

}
