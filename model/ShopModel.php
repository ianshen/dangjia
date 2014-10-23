<?php
class ShopModel extends BaseModel {
    
    protected $_table = '';
    
    public function addStoreCate($data) {
        $this->_table = 'store_category';
        return $this->add ( $data );
    }
}