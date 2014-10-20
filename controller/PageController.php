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
	
	public function showAction() {
		$this->display ();
	}
}