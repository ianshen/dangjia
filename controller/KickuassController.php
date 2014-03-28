<?php
class KickuassController extends BaseController {
	
	public function indexAction() {
		$url = ComTool::url ( 'kickuass/cate', array () );
		$this->display ();
	}
	
	/**
	 * 添加群组
	 */
	public function groupAction() {
		if (ComTool::isAjax ()) {
			ComTool::validToken ();
			$name = trim ( $this->post ( 'name' ) );
			ComTool::checkEmpty ( $name, '群组名不能为空' );
			$ename = trim ( $this->post ( 'ename' ) );
			ComTool::checkEmpty ( $ename, '群组拼音不能为空' );
			$city = $this->post ( 'city' );
			$area = $this->post ( 'area' );
			$status = $this->post ( 'status' );
			$res = GroupData::add ( array (
				'name' => $name, 
				'ename' => $ename, 
				'status' => $status, 
				'create_time' => time (), 
				'create_date' => date ( 'Y-m-d' ), 
				'city' => $city, 
				'area' => $area 
			) );
			ComTool::result ( $res );
		}
		$groups = GroupData::getsAll ();
		$this->assign ( 'list', $groups );
		$this->display ();
	}
	
	/**
	 * 添加店铺
	 */
	public function storeAction() {
		if (ComTool::isAjax ()) {
			$name = $this->post ( 'name' );
			$ename = $this->post ( 'ename' );
			$contact = $this->post ( 'contact' );
			$tel = $this->post ( 'tel' );
			$city = $this->post ( 'city' );
			$area = $this->post ( 'area' );
			$addr = $this->post ( 'addr' );
			$status = $this->post ( 'status' );
			$data = array ();
			$data ['name'] = $name;
			$data ['ename'] = $ename;
			$data ['contact'] = $contact;
			$data ['create_time'] = time ();
			$data ['create_date'] = date ( 'Y-m-d' );
			$data ['tel'] = $tel;
			$data ['addr'] = $addr;
			$data ['city'] = $city;
			$data ['area'] = $area;
			$data ['status'] = $status;
			print_r ( $data );
			$res = StoreData::add ( $data );
			ComTool::result ( $res );
		}
		$stores = StoreData::getsAll ();
		$this->assign ( 'stores', $stores );
		$this->display ();
	}
	
	/**
	 * 添加分类
	 */
	public function cateAction() {
		if (ComTool::isAjax ()) {
			$group = $this->post ( 'group' );
			$store = $this->post ( 'store' );
			$level = $this->post ( 'level' );
			$parent = $this->post ( 'parent' );
			$name = $this->post ( 'name' );
			$ename = $this->post ( 'ename' );
			$desc = $this->post ( 'desc' );
			$limit = $this->post ( 'limit' );
			$days = $this->post ( 'day' );
			$start = $this->post ( 'start' );
			$end = $this->post ( 'end' );
			$orderway = $this->post ( 'orderway' );
			$status = $this->post ( 'status' );
			$data = array ();
			$data ['group_id'] = $group;
			$data ['store_id'] = $store;
			$data ['level'] = $level;
			$data ['pid'] = $parent;
			$data ['name'] = $name;
			$data ['ename'] = $ename;
			$data ['desc'] = $desc;
			$data ['create_time'] = time ();
			$data ['update_time'] = time ();
			$data ['time_limit'] = $limit;
			$data ['days'] = $days;
			$data ['start_time'] = $start;
			$data ['end_time'] = $end;
			$data ['order_way'] = $orderway;
			$data ['status'] = $status;
			$res = CategoryData::add ( $data );
			ComTool::result ( $res );
		}
		$parentCats = CategoryData::getParents ();
		$allCats = CategoryData::getsAll ();
		$groups = GroupData::getsAll ();
		$stores = StoreData::getsAll ();
		$this->assign ( 'parentCats', $parentCats );
		$this->assign ( 'allCats', $allCats );
		$this->assign ( 'groups', $groups );
		$this->assign ( 'stores', $stores );
		$this->display ();
	}
	
	/**
	 * 添加区域
	 */
	public function regionAction() {
		if (ComTool::isAjax ()) {
			$name = $this->post ( 'name' );
			$ename = $this->post ( 'ename' );
			$pid = $this->post ( 'pid' );
			$code = $this->post ( 'code' );
			$level = $this->post ( 'level' );
			$status = $this->post ( 'status' );
			$data = array ();
			$data ['name'] = $name;
			$data ['ename'] = $ename;
			$data ['pid'] = $pid;
			$data ['code'] = $code;
			$data ['level'] = $level;
			$data ['status'] = $status;
			$res = RegionData::add ( $data );
			ComTool::result ( $res );
		}
		$citys = RegionData::getsByPid ();
		$regions = RegionData::getsAll ();
		$this->assign ( 'citys', $citys );
		$this->assign ( 'regions', $regions );
		$this->display ();
	}
	
	/**
	 * 添加商品
	 */
	public function goodsAction() {
		if (ComTool::isAjax ()) {
			$name = $this->post ( 'name' );
			$cid = $this->post ( 'cid' );
			$price = $this->post ( 'price' );
			$desc = $this->post ( 'desc' );
			$order = $this->post ( 'order' );
			$status = $this->post ( 'status' );
			$data = array ();
			$data ['name'] = $name;
			$data ['category_id'] = $cid;
			$data ['price'] = $price;
			$data ['desc'] = $desc;
			$data ['create_time'] = time ();
			$data ['create_date'] = date ( "Y-m-d" );
			$data ['order'] = $order;
			$data ['status'] = $status;
			$res = GoodsData::add ( $data );
			ComTool::result ( $res );
		}
		$areas = RegionData::getsArea ();
		$this->assign ( 'areas', $areas );
		$goods = GoodsData::getsAll ();
		$this->assign ( 'goods', $goods );
		$this->display ();
	}
}