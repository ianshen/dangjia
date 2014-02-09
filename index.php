<?php
error_reporting ( E_ALL );
ini_set ( 'display_errors', 'on' );

header ( "Content-type: text/html; charset=utf-8" );
date_default_timezone_set ( 'Asia/Shanghai' );

require 'Cola/Cola.php';

$cola = Cola::getInstance ();
$cola->boot ()->dispatch ();
