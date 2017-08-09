<?php

namespace app\base\controller;

use ucframework\Controller;

class Index extends Controller
{

    public function index()
    {
        $this->fetch();
    }

    public function login()
    {
        $res = \app\model\Area::first();
        dump($res->id);
        
    }

}
