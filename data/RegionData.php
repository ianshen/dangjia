<?php
class RegionData extends BaseData {
    
    static function getsAll() {
        $model = new RegionModel ();
        $result = $model->getsAll ();
        return $result;
    }
    
    static function del() {
    
    }
    
    static function add($data) {
        if (! $data) {
            return false;
        }
        $model = new RegionModel ();
        $result = $model->add ( $data );
        return $result;
    }
    
    /* static function getsCity() {
        $model = new RegionModel ();
        $result = $model->getsCity ();
        return $result;
    } */
    
    static function getsArea() {
        $model = new RegionModel ();
        $result = $model->getsArea ();
        return $result;
    }
    
    static function getsByPid($pid) {
        $model = new RegionModel ();
        $result = $model->getsByPid ( $pid );
        return $result;
    }
    
    static function modify() {
    
    }
}