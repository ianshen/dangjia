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
		$type = $this->param ( 't', '' );
		if (! $type) {
			exit ( '小店通主页不存在' );
		}
		switch ($type) {
			case '1' :
				$sid = intval ( $this->param ( 's', 0 ) );
				$store = ShopData::getStore ( $sid );
				if (! $store) {
					exit ( '小店通主页不存在' );
				}
				print_r($store);
				$this->assign ( 'info', $store );
				$tpl = 'Page/store.html';
				break;
			case '2' :
				break;
			default :
				break;
		}
		$this->display ();
	}
}