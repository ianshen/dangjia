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
                'id' => 0729 
            ) 
        ), 
        '/^v-?(\d+)?$/' => array (
            'controller' => 'IndexController', 
            'action' => 'viewAction', 
            'maps' => array (
                1 => 'id' 
            ), 
            'defaults' => array (
                'id' => 0729 
            ) 
        ), 
        '/^g\/?(\d+)?$/' => array (
            'controller' => 'GroupController', 
            'action' => 'indexAction', 
            'maps' => array (
                1 => 'gid' 
            ), 
            'defaults' => array (
                'gid' => 1 
            ) 
        ), 
        '/^s\/?(\d+)?$/' => array (
            'controller' => 'StoreController', 
            'action' => 'indexAction', 
            'maps' => array (
                1 => 'sid' 
            ), 
            'defaults' => array (
                'sid' => 1 
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
    '_toolsHome' => 'tool' 
);
