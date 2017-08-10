<?php

namespace app\base\controller;

use app\model\Member;
use ucframework\Controller;

class Logreg extends Controller
{

    public function register()
    {
        
        $res = Member::create(['username' => 'admin', 'pwd' => '123456']);
        if ($res !== false)
        {
            echo "增加数据成功";
        }
    }

}
