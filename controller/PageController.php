<?php
class PageController extends BaseController {
	
	public function indexAction() {
		$sid = $this->param ( 'sid' );
	}
	
	/**
	 * 店铺page
	 */
	public function storeAction() {
		$this->display ();
	}
	
	/**
	 * 小店通
	 */
	public function showAction() {
		//http://amazeui.org/
		$this->display ();
	}
}