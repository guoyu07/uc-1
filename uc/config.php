<?php

return [
    /**
     * 全局配置
     */
    'bootstarp' => 'uc.php', //入口文件
    'default_path' => 'base/index/index', //默认访问地址

    /**
     * URL
     */
    'url' => [
        'rewrite' => false,
        'pathinfo' => true,
    ],
    /**
     * 模板
     */
    'template' => [
        'theme' => 'default',
    ],
];
