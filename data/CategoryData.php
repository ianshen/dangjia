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
	
	/**
	 * 组织某个群组的分类数据
	 * @param unknown_type $gid
	 * @return boolean|Ambigous <multitype:multitype: , unknown>
	 */
	static function groupCategorys($gid) {
		if (! $gid) {
			return false;
		}
		$model = new CategoryModel ();
		$result = $model->getsByGId ( $gid );
		if (! $result) {
			return false;
		}
		$root = array ();
		foreach ( $result as $k => $cat ) {
			if ($cat ['pid'] == 0 && $cat ['level'] == 1) {
				$cat ['children'] = array ();
				$root [$cat ['id']] = $cat;
				unset ( $result [$k] );
			}
		}
		if (! $result) {
			return false;
		}
		foreach ( $result as $k => $cat ) {
			$root [$cat ['pid']] ['children'] [] = $cat;
		}
		return $root;
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
		$result = $model->getParents ();
		return $result;
	}
	
	static function modify() {
	
	}
}