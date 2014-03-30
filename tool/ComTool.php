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
	
	/**
	 * 是否为ajax提交
	 * @return boolean
	 */
	static function isAjax() {
		return Cola_Request::isAjax ();
	}
	
	/**
	 * 以ajax方式返回数据
	 * @param unknown_type $status
	 * @param unknown_type $info
	 * @param unknown_type $data
	 */
	static function ajax($status = 100000, $info = 'success', $data = 'success') {
		$json ['status'] = $status;
		$json ['info'] = $info;
		$json ['data'] = $data;
		header ( 'Content-Type:text/html; charset=utf-8' );
		echo json_encode ( $json );
		exit ();
	}
	
	/**
	 * 当前url
	 * @return string
	 */
	static function currentUrl() {
		return Cola_Request::currentUrl ();
	}
	
	/**
	 * 检查数据是否空
	 * @param unknown_type $str
	 * @param unknown_type $info
	 * @param unknown_type $status
	 * @param unknown_type $data
	 * @return unknown
	 */
	static function checkEmpty($str = '', $info = '', $status = 100001, $data = '') {
		return empty ( $str ) ? self::ajax ( $status, $info, $data ) : $str;
	}
	
	static function urlRoot() {
		$host = $_SERVER ['HTTP_HOST'];
		$url = 'http';
		if ('on' == Cola_Request::server ( 'HTTPS' ))
			$url .= 's';
		$url .= "://" . Cola_Request::server ( 'SERVER_NAME' );
		$port = Cola_Request::server ( 'SERVER_PORT' );
		if (80 != $port)
			$url .= ":{$port}";
		return $url . Cola_Request::server ( 'SCRIPT_NAME' ) . '/';
	}
	
	/**
	 * 生成url
	 * @param unknown_type $path
	 * @param unknown_type $params
	 * @return string
	 */
	static function url($path, $params = array()) {
		self::urlRoot () . $path;
	}
	
	/**
	 * 生成token
	 * @return string
	 */
	static function buildToken() {
		$tokenName = 'token';
		if (! isset ( $_SESSION [$tokenName] )) {
			$_SESSION [$tokenName] = array ();
		}
		//标识当前页面唯一性
		$tokenKey = md5 ( $_SERVER ['REQUEST_URI'] );
		if (isset ( $_SESSION [$tokenName] [$tokenKey] )) { //相同页面不重复生成session
			$tokenValue = $_SESSION [$tokenName] [$tokenKey];
		} else {
			$tokenValue = md5 ( microtime ( TRUE ) );
			$_SESSION [$tokenName] [$tokenKey] = $tokenValue;
		}
		$token = '<input type="hidden" name="' . $tokenName . '" value="' . $tokenKey . '_' . $tokenValue . '" />';
		return $token;
	}
	
	/**
	 * 检查token
	 * @return boolean
	 */
	static function checkToken() {
		$tokenName = 'token';
		if (! isset ( $_POST [$tokenName] )) {
			return true;
		}
		$token = trim ( $_POST [$tokenName] );
		$tokens = explode ( '_', $token );
		$tokenKey = $tokens [0];
		$tokenValue = $tokens [1];
		$return = ($_SESSION [$tokenName] [$tokenKey] == $tokenValue) ? true : false;
		unset ( $_SESSION [$tokenName] [$tokenKey] );
		self::buildToken ();
		return $return;
	}
	
	/**
	 * 封装token检测
	 */
	static function validToken() {
		if (! ComTool::checkToken ()) {
			self::ajax ( 100001, '数据不可重复提交' );
		}
	}
	
	/**
	 * 
	 * @param unknown_type $res
	 * @param unknown_type $err
	 * @param unknown_type $succ
	 */
	static function result($res, $err = 'error', $succ = 'success') {
		$res === false ? ComTool::ajax ( 100001, $err ) : ComTool::ajax ( 100000, $succ, $succ );
	}
	
	/**
	 * 跳转
	 * @param unknown_type $url
	 * @param unknown_type $time
	 * @param unknown_type $msg
	 */
	static function redirect($url, $time = 0, $msg = '') {
		//多行URL地址支持
		$url = str_replace ( array (
			"\n", 
			"\r" 
		), '', $url );
		if (empty ( $msg ))
			$msg = "系统将在{$time}秒之后自动跳转！";
		if (! headers_sent ()) {
			// redirect
			if (0 === $time) {
				header ( 'Location: ' . $url );
			} else {
				header ( "refresh:{$time};url={$url}" );
				echo ($msg);
			}
			exit ();
		} else {
			$str = "<meta http-equiv='Refresh' content='{$time};URL={$url}'>";
			if ($time != 0)
				$str .= $msg;
			exit ( $str );
		}
	}
}