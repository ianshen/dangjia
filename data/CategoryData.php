<?php
class CategoryData extends BaseData {
    
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
        $model = new CategoryModel ();
        $result = $model->add ( $data );
        return $result;
    }
    
    static function modify() {
    
    }
}