<?php

namespace ucframework\lib;

use Exception;
use ucframework\lib\Config;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class Router
{

    private $_context;
    private $_routes;
    private $_matcher;
    private $_generator;
    private static $_instance;

    private function __construct()
    {
        $this->_context = new RequestContext();
        $this->_routes = new RouteCollection();
        $this->_matcher = new UrlMatcher($this->_routes, $this->_context);
        $this->_generator = new UrlGenerator($this->_routes, $this->_context);
        $this->registerRoute(include APP_PATH . 'uc/route.php');
    }

    /**
     * 
     * @return \ucframework\lib\Router
     */
    public static function getInstance()
    {
        if (!(self::$_instance instanceof self))
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function registerRoute($rule)
    {
        foreach ($rule as $k => $r)
        {
            $route = new Route(
                    $k, array('path' => $r['path']), isset($r['param']) ? $r['param'] : []
            );
            $this->_routes->add($r['path'], $route);
        }
    }

    public function generateUrl($path, $param = [])
    {
        $scripturl = get_script_path();
        $config = Config::getInstance()->get('config');
        if (!$config['url']['rewrite'])
        {
            $scripturl .= $config['bootstarp'] . '/';
        }
        try
        {
            $url = $this->_generator->generate($path, $param);
            return $scripturl . ltrim($url, '/');
        } catch (Exception $ex)
        {
            if ($config['url']['pathinfo'])
            {
                $get = '';
                foreach ($param as $k => $p)
                {
                    $get .= $k . '/' . $p . '/';
                }
                return $scripturl . trim($path, '/') . '/' . $get;
            } else
            {
                $mca = explode('/', trim($path, '/'));
                return rtrim($scripturl, '/') . '?m=' . $mca[0] . '&c=' . $mca[1] . '&a=' . $mca[2] . '&' . http_build_query($param);
            }
        }
    }

    public function matchUrl($url = '')
    {
        $url = $url == '' ? str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['PHP_SELF']) : $url;
        try
        {
            $parameters = $this->_matcher->match($url);
            $mca = explode('/', $parameters['path']);
            unset($parameters['path']);
            unset($parameters['_route']);
            foreach ($parameters as $k => $p)
            {
                $_GET[$k] = $p;
            }
            return $mca;
        } catch (Exception $ex)
        {

            return $this->getNormalUrl();
        }
    }

    private function getNormalUrl()
    {
        if (isset($_SERVER['PATH_INFO']))
        {
            $path = explode('/', trim($_SERVER['PATH_INFO'], '/'));
            $patharrcount = count($path);
            if ($patharrcount < 3)
            {

                $config = Config::getInstance()->get('config');
                return explode('/', $config['default_path']);
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
            if (!isset($_GET['m']) || !isset($_GET['c']) || !isset($_GET['a']))
            {
                $config = Config::getInstance()->get('config');
                return explode('/', $config['default_path']);
            }
            unset($_GET['m']);
            unset($_GET['c']);
            unset($_GET['a']);
            return [$_GET['m'], $_GET['c'], $_GET['a']];
        }
    }

    /**
     * 覆盖__clone()方法，禁止克隆   
     */
    private function __clone()
    {
        
    }

}
