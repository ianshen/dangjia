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
                'id' => 9527 
            ) 
        ), 
        
        '/^v-?(\d+)?$/' => array (
            'controller' => 'IndexController', 
            'action' => 'viewAction', 
            'maps' => array (
                1 => 'id' 
            ), 
            'defaults' => array (
                'id' => 9527 
            ) 
        ) 
    ), 
    
    '_db' => array (
        'adapter' => 'Mysqli', 
        'params' => array (
            'host' => '127.0.0.1', 
            'port' => 3306, 
            'user' => 'test', 
            'password' => 'test', 
            'database' => 'test', 
            'charset' => 'utf8', 
            'persitent' => true 
        ) 
    ), 
    
    '_modelsHome' => 'model', 
    '_datasHome' => 'data', 
    '_controllersHome' => 'controller', 
    '_viewsHome' => 'view', 
    '_toolsHome' => 'tool' 
);
