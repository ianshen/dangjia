<?php
class CategoryModel extends BaseModel {
	
	protected $_table = '`category`';
	
	public function getsByGid($gid) {
		try {
			$result = $this->find ( "group_id='{$gid}'" );
			return $result;
		} catch ( Exception $e ) {
			echo $e;
		}
	}
	
	public function getById($id) {
		try {
			$result = $this->find ( "id='{$id}'" );
			return $result;
		} catch ( Exception $e ) {
			echo $e;
		}
	}
	
	public function getParents() {
		try {
			$result = $this->find ( 'pid=0' );
			return $result;
		} catch ( Exception $e ) {
			echo $e;
		}
		return $result;
	}
}