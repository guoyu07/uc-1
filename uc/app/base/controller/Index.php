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
        $member = new \app\model\Member();
        $res = $member->getEntityRepository()->find(1);
        dump($res);
        
    }

}
