<?php
class GroupData extends BaseData {
	
	static function getsAll() {
		$model = new GroupModel ();
		$result = $model->getsAll ();
		return $result;
	}
	
	static function dataByWhere($where) {
		if (! $where) {
			return false;
		}
		$model = new GroupModel ();
		$result = $model->dataByWhere ( $where );
		if (! $result) {
			return false;
		}
		$list = array ();
		foreach ( $result as $k => $item ) {
			$list [$item ['id']] = $item;
		}
		return $list;
	}
	
	static function getById($id) {
		if (! $id) {
			return false;
		}
		$model = new GroupModel ();
		$result = $model->getById ( $id );
		if (! $result) {
			return false;
		}
		return $result [0];
	}
	
	/**
	 * 根据region_id获取圈子
	 * @param unknown_type $rid
	 * @return boolean|Ambigous <multitype:, boolean, unknown>
	 */
	static function getsByRid($rid) {
		if (! $rid) {
			return false;
		}
		$model = new GroupModel ();
		$result = $model->getsByRid ( $rid );
		return $result;
	}
	
	static function del() {
	
	}
	
	static function add($data) {
		if (! $data) {
			return false;
		}
		$model = new GroupModel ();
		$result = $model->add ( $data );
		return $result;
	}
	
	static function modify() {
	
	}
}