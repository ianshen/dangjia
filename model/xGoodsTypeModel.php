<?php
class GoodsTypeModel extends BaseModel {
    
    protected $_table = 'goods_type';
    
    public function getsBySid($sid) {
        try {
            $result = $this->find ( "store_id='{$sid}'" );
            return $result;
        } catch ( Exception $e ) {
            echo $e;
        }
    }
}