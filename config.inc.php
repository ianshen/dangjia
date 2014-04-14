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
        'charset' => 'utf8', 
        'persitent' => true 
    ), 
    
    '_modelsHome' => 'model', 
    '_datasHome' => 'data', 
    '_controllersHome' => 'controller', 
    '_viewsHome' => 'view', 
    '_toolsHome' => 'tool', 
    '_autoSession' => true, 
    '_error' => array (
        'ok' => '100000', 
        'err' => '100001', 
        'needlogin' => '100002',  //需要登录
        'wrongcaptcha' => '100003'  //验证码错误
    ) 
);
