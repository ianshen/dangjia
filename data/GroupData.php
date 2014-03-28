<?php
class GroupData extends BaseData {
    
    static function getsAll() {
        $model = new GroupModel ();
        $result = $model->getsAll ();
        return $result;
    }
    
    static function getById($id) {
        if (! $id) {
            return false;
        }
        $model = new GroupModel ();
        $result = $model->getById ( $id );
        return $result;
    }
    
    /**
     * 根据region_id获取圈子
     * @param unknown_type $rid
     * @return boolean|Ambigous <multitype:, boolean, unknown>
     */
    static function getsByRid($rid) {
        if (! $rid) {
            return false;
        }
        $model = new GroupModel ();
        $result = $model->getsByRid ( $rid );
        return $result;
    }
    
    static function del() {
    
    }
    
    static function add($data) {
        if (! $data) {
            return false;
        }
        $model = new GroupModel ();
        $result = $model->add ( $data );
        return $result;
    }
    
    static function modify() {
    
    }
}