<?php
class StoreData extends BaseData {
    
    static function getsAll() {
        $model = new StoreModel ();
        $result = $model->getsAll ();
        return $result;
    }
    
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
    
    static function add($data) {
    	if (! $data) {
    		return false;
    	}
    	$model = new StoreModel ();
    	$result = $model->add ( $data );
    	return $result;
    }
    
    static function modify() {
    
    }
}