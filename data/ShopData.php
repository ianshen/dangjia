<?php
class ShopData extends BaseData {
    
    static function addStoreCate($data) {
        if (! $data) {
            return false;
        }
        $model = new ShopModel ();
        $result = $model->addStoreCate ( $data );
        return $result;
    }
}