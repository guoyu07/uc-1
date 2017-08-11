<?php

namespace app\base\controller;

use ucframework\Controller;

class Index extends Controller
{

    public function index()
    {
        dump((new \Nette\Http\Request(new \Nette\Http\UrlScript()))->getCookies());
        die;
        $this->fetch();
    }

    public function login()
    {
        $res = \app\model\Area::first();
        dump($res->id);
    }

}
