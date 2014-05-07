<?php
class CategoryController extends BaseController {
	
	public function indexAction() {
		$cid = $this->param ( 'cid' );
		$category = CategoryData::getById ( $cid );
		$curTime = time ();
		$category ['start_time'] = '11:00:00';
		$category ['end_time'] = '24:00:00';
		$startTime = $category ['start_time'];
		$startTime = strtotime ( $startTime );
		$endTime = $category ['end_time'];
		$endTime = strtotime ( $endTime );
		$notStart = $curTime < $startTime ? true : false; //true为尚未开始
		$isOver = $curTime > $endTime ? true : false; //true为已结束
		$isOn = ! $notStart && ! $isOver;
		$this->assign ( 'notStart', $notStart );
		$this->assign ( 'isOver', $isOver );
		$this->assign ( 'isOn', $isOn );
		$group = GroupData::getById ( $category ['group_id'] );
		$store = StoreData::getById ( $category ['store_id'] );
		$goods = GoodsData::getsByCid ( $cid );
		$this->assign ( 'category', $category );
		$this->assign ( 'group', $group );
		$this->assign ( 'store', $store );
		$this->assign ( 'goods', $goods );
		$cart = array ();
		$cart = $this->getCart ( $cid );
		$this->assign ( 'products', $cart ['products'] );
		$this->assign ( 'totalPrice', $cart ['totalPrice'] );
		$this->display ();
	}
}