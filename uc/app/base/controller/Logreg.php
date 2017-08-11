<?php

namespace app\base\controller;

use app\model\Member;
use ucframework\Controller;

class Logreg extends Controller
{

    public function register()
    {
       (new \Nette\Http\Response(new \Nette\Http\UrlScript()))->setCookie("abc","adasd",1000000 );
        cookie("username", [1,2,4]);
        die;
        $res = Member::create(['username' => 'admin', 'pwd' => '123456']);
        if ($res !== false)
        {
            echo "增加数据成功";
        }
    }

}
