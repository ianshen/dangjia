<?php
error_reporting ( E_ALL );
ini_set ( 'display_errors', 'on' ); //线上设置为off


date_default_timezone_set ( 'Asia/Shanghai' );

header ( "Content-type: text/html; charset=utf-8" );

define ( 'WWW_ROOT', rtrim ( dirname ( $_SERVER ['SCRIPT_NAME'] ), '/\\' ) . '/' ); //定义www根域


//defined ( 'APP_PATH' ) or define ( 'APP_PATH', dirname ( $_SERVER ['SCRIPT_FILENAME'] ) . '/' );
require 'Cola/Cola.php';
$cola = Cola::getInstance ();
$cola->boot ()->dispatch ();