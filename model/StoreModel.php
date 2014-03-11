<?php
class StoreModel extends BaseModel {
    
    protected $_table = '`store`';
    
    public function getById($id) {
        try {
            $result = $this->find ( "id='{$id}'" );
            return $result;
        } catch ( Exception $e ) {
            echo $e;
        }
    }
    
    public function getsByIds($ids) {
        try {
            $result = $this->find ( "id in({$ids})" );
            return $result;
        } catch ( Exception $e ) {
            echo $e;
        }
    }
}