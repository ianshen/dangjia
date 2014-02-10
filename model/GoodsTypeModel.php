<?php
class GoodsTypeModel extends Cola_Model {
	
	protected $_table = 'goods_type';
	
	public function getsBySid($sid) {
		try {
			$result = $this->find ( "store_id='{$sid}'" );
			return $result;
		} catch ( Exception $e ) {
			echo $e;
		}
	}
	
	public function del() {
	
	}
	
	public function add() {
	
	}
	
	public function modify() {
	
	}
}