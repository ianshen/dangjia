<?php
class UserGroupData extends BaseData {
    
    static function getsGroupByUID($uid) {
        if (! $uid) {
            return false;
        }
        $model = new UserGroupModel ();
        $result = $model->getsGroupByUID ( $uid );
        return $result;
    }
    
    static function getById($id) {
        if (! $id) {
            return false;
        }
        $model = new UserGroupModel ();
        $result = $model->getById ( $id );
        return $result;
    }
    
    static function add($data) {
        if (! $data) {
            return false;
        }
        $model = new UserGroupModel ();
        $result = $model->add ( $data );
        return $result;
    }
    
    static function del($id) {
        if (! $id) {
            return false;
        }
        $model = new UserGroupModel ();
        $result = $model->del ( $id );
        return $result;
    }
    
    static function modify($id, $data) {
        if (! $id || ! $data) {
            return false;
        }
        $model = new UserGroupModel ();
        $result = $model->update ( $id, $data );
        return $result;
    }
}