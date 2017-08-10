<?php

namespace components\captcha;

use components\Icomponents;
use Gregwar\Captcha\CaptchaBuilder;

class Basic implements Icomponents
{

    public function run(&$param = [])
    {
        header('Content-type: image/jpeg');
        $builder = new CaptchaBuilder();
        $builder->build();
        $builder->output();
        die;
    }

}
