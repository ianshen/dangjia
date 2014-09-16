<?php
class BaseData {
    
    static function sql($sql) {
        if (! $sql) {
            return false;
        }
        $model = new BaseModel ();
        $result = $model->sql ( $sql );
        return $result;
    }
}