<?php
class UserModel extends BaseModel {
    
    protected $_table = '`user`';
    
    public function getById($id) {
        try {
            $result = $this->find ( "id='{$id}'" );
            return $result;
        } catch ( Exception $e ) {
            echo $e;
        }
    }
}