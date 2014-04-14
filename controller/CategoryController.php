<?php
class CategoryController extends BaseController {
	
	public function indexAction() {
		$cid = $this->param ( 'cid' );
		$category = CategoryData::getById ( $cid );
		$group = GroupData::getById ( $category ['group_id'] );
		$store = StoreData::getById ( $category ['store_id'] );
		$goods = GoodsData::getsByCid ( $cid );
		$this->assign ( 'category', $category );
		$this->assign ( 'group', $group );
		$this->assign ( 'store', $store );
		$this->assign ( 'goods', $goods );
		$this->display ();
	}
}