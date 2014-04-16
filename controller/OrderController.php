<?php
class OrderController extends BaseController {
	
	public function indexAction() {
		$this->display ();
	}
	
	/**
	 * 购物车
	 */
	public function cartAction() {
		$gid = intval ( base64_decode ( $this->param ( 'g' ) ) );
		$cid = intval ( base64_decode ( $this->param ( 'c' ) ) );
		if (ComTool::isAjax ()) {
		
		}
		$category = CategoryData::getById ( $cid );
		if ($category ['group_id'] != $gid) {
			exit ( 'wrong params' );
		}
		$cart = ComTool::getCart ( $cid );
		$this->assign ( 'products', $cart ['products'] );
		$this->assign ( 'totalPrice', $cart ['totalPrice'] );
		$this->display ();
	}
	
	/**
	 * 加入购物车
	 */
	public function acAction() {
		if (ComTool::isAjax ()) {
			$productId = intval ( $this->post ( 'proid', 0 ) );
			if (! $productId) {
				ComTool::ajax ( 100001, '服务器忙，请刷新重试' );
			}
			$product = GoodsData::getById ( $productId );
			if (! $product) {
				ComTool::ajax ( 100001, '服务器忙，请重试' );
			}
			if (! isset ( $_SESSION ['cart'] )) {
				$_SESSION ['cart'] = array ();
			}
			$curCategory = $product ['category_id'];
			if (! isset ( $_SESSION ['cart'] [$curCategory] )) {
				$_SESSION ['cart'] [$curCategory] = array ();
			}
			if (isset ( $_SESSION ['cart'] [$curCategory] [$productId] ) && $_SESSION ['cart'] [$curCategory] [$productId]) {
				$productQuantity = intval ( $_SESSION ['cart'] [$curCategory] [$productId] ['quantity'] ) + 1;
				$_SESSION ['cart'] [$curCategory] [$productId] = array (
					'id' => $product ['id'], 
					'name' => $product ['name'], 
					'price' => $product ['price'], 
					'price_num' => $product ['price_num'], 
					'price_unit' => $product ['price_unit'], 
					'quantity' => $productQuantity 
				);
			} else {
				$_SESSION ['cart'] [$curCategory] [$productId] = array (
					'id' => $product ['id'], 
					'name' => $product ['name'], 
					'price' => $product ['price'], 
					'price_num' => $product ['price_num'], 
					'price_unit' => $product ['price_unit'], 
					'quantity' => 1 
				);
			}
			//计算总价
			ComTool::ajax ( 100000, 'ok' );
		}
	}
	
	/**
	 * 删除购物车物品
	 */
	public function dcAction() {
		if (ComTool::isAjax ()) {
			$curCategory = '';
			$productId = intval ( $this->post ( 'pid' ) );
			$_SESSION ['cart'] [$curCategory] [$productId] = array ();
			unset ( $_SESSION ['cart'] [$curCategory] [$productId] );
			ComTool::ajax ( 100000, 'ok' );
		}
	}
	
	/**
	 * update cart更新购物车
	 */
	public function ucAction() {
		if (ComTool::isAjax ()) {
			$type = $this->post ( 'type' );
			$curCategory = intval ( $this->post ( 'cat' ) );
			$productId = intval ( $this->post ( 'pid' ) );
			$product = GoodsData::getById ( $productId );
			$productInCart = $_SESSION ['cart'] [$curCategory] [$productId];
			$productQuantity = intval ( $productInCart ['quantity'] );
			switch ($type) {
				case 'i' : //increment
					$productInCart ['quantity'] = $productQuantity + 1;
					$_SESSION ['cart'] [$curCategory] [$productId] = $productInCart;
					break;
				case 'd' : //decrement
					$productInCart ['quantity'] = $productQuantity - 1;
					if ($productInCart ['quantity'] <= 0) {
						$_SESSION ['cart'] [$curCategory] [$productId] = array ();
						unset ( $_SESSION ['cart'] [$curCategory] [$productId] );
					} else {
						$_SESSION ['cart'] [$curCategory] [$productId] = $productInCart;
					}
					break;
			}
			ComTool::ajax ( 100000, 'ok' );
		}
	}
	
	/**
	 * 提交订单
	 */
	public function goAction() {
		if (ComTool::isAjax ()) {
			$curCategory = '';
			$cart = $_SESSION ['cart'] [$curCategory];
			if (! $cart) {
				ComTool::ajax ( 100001, '购物车为空' );
			}
		
		}
	}
	
	/**
	 * 取消订单
	 */
	public function cancelAction() {
	
	}
}