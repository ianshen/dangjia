<?php
class ShopModel extends BaseModel {
	
	protected $_table = '';
	
	public function addStoreCate($data) {
		$this->_table = 'store_category';
		return $this->add ( $data );
	}
	
	public function addStoreGood($data) {
		$this->_table = 'store_goods';
		return $this->add ( $data );
	}
}