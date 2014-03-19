<?php
class CategoryData extends BaseData {
	
	static function getsByIds($ids) {
		if (! $ids) {
			return false;
		}
		$model = new CategoryModel ();
		$result = $model->getsByIds ( $ids );
		return $result;
	}
	
	static function getsAll() {
		$model = new CategoryModel ();
		$result = $model->getsAll ();
		return $result;
	}
	
	static function del() {
	
	}
	
	static function add($data) {
		if (! $data) {
			return false;
		}
		$model = new CategoryModel ();
		$result = $model->add ( $data );
		return $result;
	}
	
	static function getParents() {
		$model = new CategoryModel ();
		$result = $model->find ( array (
			'pid' => 0 
		) );
		return $result;
	}
	
	static function modify() {
	
	}
}