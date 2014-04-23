<?php
class BaseController extends Cola_Controller {
	
	public $tplExt = '.html';
	
	protected $mustLogin = 0;
	
	protected $token = '';
	
	public function __construct() {
		/* $this->token = ComTool::buildToken ();
        $this->assign ( 'token', $this->token ); */
		$urlroot = ComTool::urlRoot ();
		$this->assign ( 'urlroot', $urlroot );
		$this->assign ( 'wwwroot', WWW_ROOT );
	}
	
	/**
	 * 判断是否登录
	 * @return boolean
	 */
	protected function isLogin() {
		return isset ( $_SESSION ['islogin'] ) && $_SESSION ['islogin'] ? true : false;
	}
	
	/**
	 * 获取当前登录用户
	 * @return Ambigous <multitype:, unknown>
	 */
	protected function getCurrentUser() {
		return isset ( $_SESSION ['user'] ) && $_SESSION ['user'] ? $_SESSION ['user'] : array ();
	}
	
	/**
	 * 获取某分类的购物车
	 * @param unknown_type $categoryId
	 * @return multitype:multitype: number unknown 
	 */
	protected function getCart($categoryId) {
		$cart = array ();
		$cart ['products'] = array ();
		$cart ['totalPrice'] = 0;
		if (isset ( $_SESSION ['cart'] [$categoryId] )) {
			$products = $_SESSION ['cart'] [$categoryId];
			$totalPrice = 0;
			foreach ( $products as &$v ) {
				$v ['thisTotalPrice'] = intval ( $v ['price'] ) * intval ( $v ['quantity'] );
				$totalPrice += $v ['thisTotalPrice'];
			}
			$cart ['products'] = $products;
			$cart ['totalPrice'] = $totalPrice;
		}
		return $cart;
	}
}