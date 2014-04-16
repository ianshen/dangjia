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
		/* if (isset ( $_SESSION ['cart'] [$cid] )) {
			$curCart = $_SESSION ['cart'] [$cid];
			$totalPrice = 0;
			foreach ( $curCart as &$v ) {
				$v ['thisTotalPrice'] = intval ( $v ['price'] ) * intval ( $v ['quantity'] );
				$totalPrice += $v ['thisTotalPrice'];
			}
			$this->assign ( 'curCart', $curCart );
			$this->assign ( 'totalPrice', $totalPrice );
		} */
		$cart = ComTool::getCart ( $cid );
		$this->assign ( 'products', $cart ['products'] );
		$this->assign ( 'totalPrice', $cart ['totalPrice'] );
		//print_r ( $curCart );
		$this->display ();
	}
}