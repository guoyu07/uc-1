<?php

namespace ucframework\lib;

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

    public function __construct()
    {
        $this->_context = new RequestContext();
        $this->_routes = new RouteCollection();
        $this->_matcher = new UrlMatcher($this->_routes, $this->_context);
        $this->_generator = new UrlGenerator($this->_routes, $this->_context);
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
        try
        {
            $url = $this->_generator->generate($path, $param);
            dump($url);
        } catch (Exception $ex)
        {
            
        }
    }

    public function matchUrl($url = '')
    {
        try
        {
           
            $parameters = $this->_matcher->match($url);
        } catch (ResourceNotFoundException $ex)
        {

            return $this->getNormalUrl();
        }
    }

    private function getNormalUrl()
    {
        if (isset($_SERVER['PATH_INFO'])) //pathinfo
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
