<?php
class GoodsData extends BaseData {
	
	static function getsAll() {
		$model = new GoodsModel ();
		$result = $model->getsAll ();
		return $result;
	}
	
	static function getById($id) {
		if (! $id) {
			return false;
		}
		$model = new GoodsModel ();
		$result = $model->getById ( $id );
		if (! $result) {
			return false;
		}
		return $result [0];
	}
	
	static function getsByCid($cid) {
		if (! $cid) {
			return false;
		}
		$model = new GoodsModel ();
		$result = $model->getsByCid ( $cid );
		return $result;
	}
	
	static function del() {
	
	}
	
	static function add($data) {
		if (! $data) {
			return false;
		}
		$model = new GoodsModel ();
		$result = $model->add ( $data );
		return $result;
	}
	
	static function modify() {
	
	}
}