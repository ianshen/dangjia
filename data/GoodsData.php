<?php
class GoodsData extends BaseData {
    
    static function getsBySid($sid) {
        if (! $sid) {
            return false;
        }
        $model = new GoodsTypeModel ();
        $result = $model->getsBySid ( $sid );
        return $result;
    }
    
    static function del() {
    
    }
    
    static function add() {
    
    }
    
    static function modify() {
    
    }
}