<?php
class RegionModel extends BaseModel {
	
	protected $_table = '`region`';
	
	public function getsCity() {
		try {
			$result = $this->find ( 'pid=0' );
			return $result;
		} catch ( Exception $e ) {
			echo $e;
		}
		return $result;
	}
	
	public function getsArea() {
		try {
			$result = $this->find ( 'pid!=0' );
			return $result;
		} catch ( Exception $e ) {
			echo $e;
		}
		return $result;
	}
}