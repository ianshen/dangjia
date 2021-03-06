<?php
$config = array (
    '_urls' => array (
        '/^view\/?(\d+)?$/' => array (
            'controller' => 'IndexController', 
            'action' => 'viewAction', 
            'maps' => array (
                1 => 'id' 
            ), 
            'defaults' => array (
                'id' => 729 
            ) 
        ), 
        '/^v-?(\d+)?$/' => array (
            'controller' => 'IndexController', 
            'action' => 'viewAction', 
            'maps' => array (
                1 => 'id' 
            ), 
            'defaults' => array (
                'id' => 729 
            ) 
        ), 
        '/^g\/?(\d+)?$/' => array (
            'controller' => 'GroupController', 
            'action' => 'indexAction', 
            'maps' => array (
                1 => 'gid' 
            ), 
            'defaults' => array (
                'gid' => 729 
            ) 
        ), 
        '/^c\/?(\d+)?$/' => array (
            'controller' => 'CategoryController', 
            'action' => 'indexAction', 
            'maps' => array (
                1 => 'cid' 
            ), 
            'defaults' => array (
                'cid' => 729 
            ) 
        ) 
    ), 
    
    '_db' => array (
        'adapter' => 'Pdo_Mysql', 
        'host' => 'localhost', 
        'port' => 3306, 
        'user' => 'root', 
        'password' => '', 
        'database' => 'xiaodangjia', 
        //         'persitent' => true, 
        'charset' => 'utf8' 
    ), 
    
    '_modelsHome' => 'model', 
    '_datasHome' => 'data', 
    '_controllersHome' => 'controller', 
    '_viewsHome' => 'view', 
    '_toolsHome' => 'tool', 
    '_groupsNumLimit' => '3', //每用户可加入的分组数限制
    '_error' => array (
        'ok' => '100000', 
        'err' => '100001', 
        'mustlogin' => '100002',  //需要登录
        'wrongcaptcha' => '100003'  //验证码错误
    ), 
    '_session' => array (
        'autoStart' => true 
    ), 
    '_cookie' => array (
        'COOKIE_PREFIX' => '', 
        'COOKIE_EXPIRE' => '', 
        'COOKIE_PATH' => '', 
        'COOKIE_DOMAIN' => '' 
    ) 
);
