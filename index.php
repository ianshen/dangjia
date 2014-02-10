<?php
error_reporting ( E_ALL );
ini_set ( 'display_errors', 'on' );

date_default_timezone_set ( 'Asia/Shanghai' );

header ( "Content-type: text/html; charset=utf-8" );

$root = dirname ( $_SERVER ['SCRIPT_NAME'] );
if ($root && $root != '/') {
    $root .= "/";
}
define ( 'APP_DIR', $root );

require 'Cola/Cola.php';

$cola = Cola::getInstance ();
$cola->boot ()->dispatch ();