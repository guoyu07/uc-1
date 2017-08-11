<?php

namespace ucframework\lib;

use Nette\Http\Session;
use Nette\Http\Request;
use Nette\Http\Response;
use Nette\Http\IRequest;
use Nette\Http\IResponse;
use Nette\Http\UrlScript;

class Http
{

    private static $_instance;
    private static $_request;
    private static $_response;
    private static $_session;

    private function __construct()
    {
        
    }

    /**
     * 
     * @return \ucframework\lib\Http
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
     * @return \Nette\Http\Request
     */
    public function Request()
    {
        if (!self::$_request instanceof Request)
        {
            $UrlScript = new UrlScript(get_url());
            $UrlScript->setScriptPath(get_script_path());
            self::$_request = new Request($UrlScript);
        }
        return self::$_request;
    }

    /**
     * 
     * @return Response
     */
    public function Response()
    {
        if (!self::$_response instanceof Response)
        {
            $UrlScript = new UrlScript(get_url());
            $UrlScript->setScriptPath(get_script_path());
            self::$_response = new Response($UrlScript);
        }
        return self::$_response;
    }

    /**
     * 
     * @return Session
     */
    public function Session()
    {
        if (!self::$_session instanceof Session)
        {
            $Session = new Session(IRequest, IResponse);
            if (!$Session->isStarted())
            {
                $Session->start();
            }
            self::$_session = $Session;
        }
        return self::$_session;
    }

}
