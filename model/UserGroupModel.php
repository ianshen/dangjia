<?php
class UserGroupModel extends BaseModel {
	
	protected $_table = 'user_group';
	
	public function getById($id) {
		try {
			$result = $this->find ( "id='{$id}'" );
			return $result;
		} catch ( Exception $e ) {
			echo $e;
		}
	}
	
	/**
	 * 获取用户圈子
	 * @param unknown_type $uid
	 * @return Ambigous <multitype:, boolean, unknown>
	 */
	public function getsGroupByUID($uid) {
		try {
			$result = $this->find ( "user_id='{$uid}'" );
			return $result;
		} catch ( Exception $e ) {
			echo $e;
		}
	}
	
	public function modify($uid, $gid, $field, $data) {
		try {
			$result = $this->sql ( "update user_group set `{$field}`='{$data}' where user_id={$uid} and group_id={$gid}" );
			return $result;
		} catch ( Exception $e ) {
			echo $e;
		}
	}
}