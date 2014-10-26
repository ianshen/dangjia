<?php
class ShopData extends BaseData {
	
	static function addStoreCate($data) {
		if (! $data) {
			return false;
		}
		$model = new ShopModel ();
		$result = $model->addStoreCate ( $data );
		return $result;
	}
	
	static function addStoreGood($data) {
		if (! $data) {
			return false;
		}
		$model = new ShopModel ();
		$result = $model->addStoreGood ( $data );
		return $result;
	}
	
	static function getStoreCates($storeId) {
		$sql = "SELECT * FROM `store_category` WHERE store_id='{$storeId}' AND `status`='1';";
		$cates = BaseData::sql ( $sql );
		return $cates;
	}
	
	static function getStoreGoods($storeId) {
		$sql = "SELECT * FROM `store_goods` WHERE store_id='{$storeId}' and `status`='1';";
		$goods = BaseData::sql ( $sql );
		return $goods;
	}
	
	static function getStoreGood($id) {
		$sql = "SELECT * FROM `store_goods` WHERE id='{$id}' AND `status`='1';";
		$good = BaseData::sql ( $sql );
		if (! $good) {
			return false;
		}
		return $good [0];
	}
	
	static function editStoreGood($data) {
		$sql = "UPDATE `store_goods` SET `name`='{$data['name']}',store_cate_id='{$data['store_cate_id']}',`price`='{$data['price']}',`desc`='{$data['desc']}',update_time='{$data['update_time']}' WHERE id='{$data['id']}' AND store_id='{$data['store_id']}'";
		$res = BaseData::sql ( $sql );
		return $res;
	}
}