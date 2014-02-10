<?php
class StoreController extends BaseController {
	
	public function indexAction() {
		$sid = $this->param ( 'sid' );
		//根据storeid取店铺商品分类
		
		//根据storeid取店铺商品清单
		$goods = array (
			'uniqueid1' => array (
				'name' => '分类1', 
				'goods' => array (
					array (
						'order' => 1, 
						'name' => '商品1', 
						'price' => '33' 
					), 
					array () 
				) 
			), 
			'uniqueid2' => array (), 
			'uniqueid3' => array () 
		);
		$this->display ();
	}
}