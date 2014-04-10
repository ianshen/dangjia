<?php
class GoodsData extends BaseData {
    
    static function getsAll() {
        $model = new GoodsModel ();
        $result = $model->getsAll ();
        return $result;
    }
    
    static function getsByCid($cid) {
        if (! $cid) {
            return false;
        }
        $model = new GoodsModel ();
        $result = $model->getsByCid ( $cid );
        return $result;
    }
    
    static function del() {
    
    }
    
    static function add($data) {
        if (! $data) {
            return false;
        }
        $model = new GoodsModel ();
        $result = $model->add ( $data );
        return $result;
    }
    
    static function modify() {
    
    }
}