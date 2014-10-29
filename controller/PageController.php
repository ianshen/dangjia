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
                //print_r($store);
                $cates = ShopData::getStoreCates ( $store ['id'] );
                if ($cates) {
                    foreach ( $cates as $cate ) {
                        $tmp [$cate ['id']] = $cate;
                    }
                    $cates = $tmp;
                }
                $goods = ShopData::getStoreGoods ( $store ['id'] );
                if ($goods) {
                    foreach ( $goods as $good ) {
                        $cates [$good ['store_cate_id']] ['goods'] [] = $good;
                    }
                }
				$this->assign ( 'cates', $cates );
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