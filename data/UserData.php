<?php
class UserData {
    
    static function test() {
        $model = new UserModel ();
        $result = $model->test ();
        return $result;
    }
    
    static function getById($id) {
        if (! $id) {
            return false;
        }
        $model = new UserModel ();
        $result = $model->getById ( $id );
        return $result;
    }
}