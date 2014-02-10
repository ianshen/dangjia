<?php
class StoreData {
    
    static function getsByIds($ids) {
        if (! $ids) {
            return false;
        }
        $model = new StoreModel ();
        $result = $model->getsByIds ( $ids );
        return $result;
    }
    
    static function del() {
    
    }
    
    static function add() {
    
    }
    
    static function modify() {
    
    }
}