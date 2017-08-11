<?php

use ucframework\lib\Http;
use ucframework\lib\Router;

if (!function_exists('get_url'))
{

    /**
     * 获取当前URL
     */
    function get_url()
    {
        return $_SERVER['REQUEST_SCHEME'] . $_SERVER['SERVER_NAME']
                . ':' . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    }

}


if (!function_exists('get_script_path'))
{

    /**
     * 获取当前url的子级目录
     */
    function get_script_path()
    {
        $script_name = $_SERVER['SCRIPT_NAME'];
        $script_name_arr = explode('/', $script_name);
        unset($script_name_arr[count($script_name_arr) - 1]);
        return implode('/', $script_name_arr) . '/';
    }

}

if (!function_exists('url'))
{

    /**
     * 生成URL
     * @param string $path
     * @param array $param
     * @return string
     */
    function url($path, $param = [])
    {
        return Router::getInstance()->generateUrl($path, $param);
    }

}

if (!function_exists('request'))
{

    /**
     * 
     * @return Nette\Http\Request
     */
    function request()
    {
        return Http::getInstance()->Request();
    }

}

if (!function_exists('response'))
{

    /**
     * 
     * @return Nette\Http\Response
     */
    function response()
    {
        return Http::getInstance()->Response();
    }

}

if (!function_exists('cookie'))
{

    function cookie($name, $value = '', $option = [])
    {
        if (!$value)
        {dump(request()->getCookies());
            return json_decode(request()->getCookie($name), JSON_UNESCAPED_UNICODE);
        } else
        {
            $value = json_encode($value);
            return response()->setCookie(
                            $name, $value, isset($option['time']) ? time() + $option['time'] : 0, isset($option['path']) ? $option['path'] : null, isset($option['domain']) ? $option['domain'] : null, isset($option['secure']) ? $option['secure'] : null, isset($option['httpOnly']) ? $option['httpOnly'] : null
            );
        }
    }

}

if (!function_exists('session'))
{

    function session($name, $value = '')
    {
        if (trim($value) == '')
        {
            // return Http::getInstance()->Session()->set;
        }
    }

}