<?php
class UserData extends BaseData {
	
	static function getById($id) {
		if (! $id) {
			return false;
		}
		$model = new UserModel ();
		$result = $model->getById ( $id );
		if (! $result) {
			return false;
		}
		return $result [0];
	}
	
	static function getByEmail($email) {
		if (! $email) {
			return false;
		}
		$model = new UserModel ();
		$result = $model->getByEmail ( $email );
		if (! $result) {
			return false;
		}
		return $result [0];
	}
	
	static function getByMobile($mobile) {
		if (! $mobile) {
			return false;
		}
		$model = new UserModel ();
		$result = $model->getByMobile ( $mobile );
		if (! $result) {
			return false;
		}
		return $result [0];
	}
	
	static function add($data) {
		if (! $data) {
			return false;
		}
		$model = new UserModel ();
		$result = $model->add ( $data );
		return $result;
	}
	
	static function del($id) {
		if (! $id) {
			return false;
		}
		$model = new UserModel ();
		$result = $model->del ( $id );
		return $result;
	}
	
	static function modify($id, $data) {
		if (! $id || ! $data) {
			return false;
		}
		$model = new UserModel ();
		$result = $model->update ( $id, $data );
		return $result;
	}
}