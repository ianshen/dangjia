<?php
class ComTool {
    
    /**
     * 生成订单流水号
     * @return string
     */
    static function getOrderId() {
        //生成规则:日期|时间|毫秒|随机数
        $time = 3600 * date ( 'H' ) + 60 * date ( 'i' ) + date ( 's' );
        $microtime = microtime ();
        $microtime = explode ( ' ', $microtime );
        $msec = floor ( $microtime [0] * 1000 );
        $rand = str_pad ( mt_rand ( 0, 999 ), 3, '0', STR_PAD_LEFT );
        $serialNumber = date ( 'ymd' ) . $time . $msec . $rand;
        return $serialNumber;
    }
    
    static function isAjax() {
        return Cola_Request::isAjax ();
    }
    
    static function ajax($status = 100000, $info = 'success', $data = 'success') {
        $json ['status'] = $status;
        $json ['info'] = $info;
        $json ['data'] = $data;
        header ( 'Content-Type:text/html; charset=utf-8' );
        echo json_encode ( $json );
        exit ();
    }
    
    static function currentUrl() {
        return Cola_Request::currentUrl ();
    }
    
    static function checkEmpty($str = '', $info = '', $status = 100001, $data = '') {
        return empty ( $str ) ? self::ajax ( $status, $info, $data ) : $str;
    }
    
    static function url($path, $params = array()) {
        $host = $_SERVER ['HTTP_HOST'];
        $url = 'http';
        if ('on' == Cola_Request::server ( 'HTTPS' ))
            $url .= 's';
        $url .= "://" . Cola_Request::server ( 'SERVER_NAME' );
        $port = Cola_Request::server ( 'SERVER_PORT' );
        if (80 != $port)
            $url .= ":{$port}";
        return $url . Cola_Request::server ( 'SCRIPT_NAME' ) . '/' . $path;
    }
    
    static function buildToken() {
        $tokenName = 'token';
        $tokenType = 'md5';
        if (! isset ( $_SESSION [$tokenName] )) {
            $_SESSION [$tokenName] = array ();
        }
        //标识当前页面唯一性
        $tokenKey = md5 ( $_SERVER ['REQUEST_URI'] );
        if (isset ( $_SESSION [$tokenName] [$tokenKey] )) { //相同页面不重复生成session
            $tokenValue = $_SESSION [$tokenName] [$tokenKey];
        } else {
            $tokenValue = $tokenType ( microtime ( TRUE ) );
            $_SESSION [$tokenName] [$tokenKey] = $tokenValue;
        }
        $token = '<input type="hidden" name="' . $tokenName . '" value="' . $tokenKey . '_' . $tokenValue . '" />';
        return $token;
    }
    
    static function checkToken() {
        $tokenName = 'token';
        $token = trim ( $_POST [$tokenName] );
        $tokens = explode ( '_', $token );
        $tokenKey = $tokens [0];
        $tokenValue = $tokens [1];
        $return = ($_SESSION [$tokenName] [$tokenKey] == $tokenValue) ? true : false;
        unset ( $_SESSION [$tokenName] [$tokenKey] );
        self::buildToken ();
        return $return;
    }
}