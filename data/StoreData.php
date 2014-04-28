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
    static function getById($id) {
        if (! $id) {
			return false;
		}
		$model = new StoreModel ();
		$result = $model->getById ( $id );
		if (! $result) {
			return false;
		}
		return $result[0];
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