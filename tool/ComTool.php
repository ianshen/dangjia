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
    
    static function ajaxRender($status = 100000, $info = 'success', $data = 'success') {
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
}