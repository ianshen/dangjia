<?php
class GroupStoreData {
    
    static function getStoreIdsByGid($gid) {
        if (! $gid) {
            return false;
        }
        $model = new GroupStoreModel ();
        $result = $model->getsByGid ( $gid );
        if (! $result) {
            return false;
        }
        $ids = array ();
        foreach ( $result as $v ) {
            $ids [] = $v ['store_id'];
        }
        return $ids;
    }
    
    static function del() {
    
    }
    
    static function add() {
    
    }
    
    static function modify() {
    
    }
}