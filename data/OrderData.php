<?php
class OrderData extends BaseData {
    
    static function add($data) {
        if (! $data) {
            return false;
        }
        $model = new OrderModel ();
        $result = $model->add ( $data );
        return $result;
    }
    
    static function del($id) {
        if (! $id) {
            return false;
        }
        $model = new OrderModel ();
        $result = $model->del ( $id );
        return $result;
    }
    
    static function modify($id, $data) {
        if (! $id || ! $data) {
            return false;
        }
        $model = new OrderModel ();
        $result = $model->update ( $id, $data );
        return $result;
    }
    
    static function sql($sql) {
        if (! $sql) {
            return false;
        }
        $model = new OrderModel ();
        $result = $model->sql ( $sql );
        return $result;
    }
}