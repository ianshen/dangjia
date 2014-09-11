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
	
	static function getGroupsByUid($uid) {
        $sql = "SELECT * FROM `user_group` where user_id='{$uid}' and status=1";
        $groups = self::sql ( $sql );
        return $groups;
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
	
	static function sql($sql) {
        if (! $sql) {
            return false;
        }
        $model = new UserGroupModel ();
        $result = $model->sql ( $sql );
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