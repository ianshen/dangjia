<?php
class GoodsModel extends BaseModel {
    
    protected $_table = '`goods`';
    
    public function getsByCid($cid) {
        try {
            $result = $this->find ( "category_id='{$cid}'" );
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
}