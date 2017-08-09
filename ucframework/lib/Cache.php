<?php

namespace ucframework\lib;

use Nette\Caching\Cache as NetteCache;
use Nette\Caching\Storages\FileStorage;

class Cache
{

    private static $_instance;
    private static $_filecache;

    private function __construct()
    {
        
    }

    /**
     * 
     * @return \ucframework\lib\Cache
     */
    public static function getInstance()
    {
        if (!(self::$_instance instanceof self))
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * 
     * @return NetteCache
     */
    public static function getFileStorage()
    {
        if (!(self::$_filecache instanceof NetteCache))
        {
            $filestorage = new FileStorage(APP_PATH . 'uc/runtime/cache/');
            self::$_filecache = new NetteCache($filestorage);
        }
        return self::$_filecache;
    }

    /**
     * 覆盖__clone()方法，禁止克隆   
     */
    private function __clone()
    {
        
    }

}
