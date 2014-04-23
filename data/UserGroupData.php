<?php
class UserGroupData extends BaseData {
	
	static function getsGroupByUID($uid) {
		if (! $uid) {
			return false;
		}
		$model = new UserGroupModel ();
		$result = $model->getsGroupByUID ( $uid );
		return $result;
	}
	
	static function getById($id) {
		if (! $id) {
			return false;
		}
		$model = new UserGroupModel ();
		$result = $model->getById ( $id );
		if (! $result) {
			return false;
		}
		return $result [0];
	}
	
	static function add($data) {
		if (! $data) {
			return false;
		}
		$model = new UserGroupModel ();
		$result = $model->add ( $data );
		return $result;
	}
	
	static function del($id) {
		if (! $id) {
			return false;
		}
		$model = new UserGroupModel ();
		$result = $model->del ( $id );
		return $result;
	}
	
	static function modify($uid, $gid, $field, $data) {
		if (! $uid || $gid || ! $data) {
			return false;
		}
		$model = new UserGroupModel ();
		$result = $model->modify ( $uid, $gid, $field, $data );
		return $result;
	}
}