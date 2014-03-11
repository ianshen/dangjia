<?php
class OrderModel extends BaseModel {
    
    protected $_table = '`order`';
    
    public function getById($id) {
        try {
            $result = $this->find ( "id='{$id}'" );
            return $result;
        } catch ( Exception $e ) {
            echo $e;
        }
    }
}