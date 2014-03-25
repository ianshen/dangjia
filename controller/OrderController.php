<?php
class OrderController extends BaseController {
	
	public function indexAction() {
		$this->display ();
	}
	
	/**
	 * 购物车
	 */
	public function cartAction() {
		if (ComTool::isAjax ()) {
		
		}
		$this->display ();
	}
	
	/**
	 * 提交订单
	 */
	public function goAction() {
	
	}
	
	/**
	 * update cart更新购物车
	 */
	public function ucAction() {
	
	}
}