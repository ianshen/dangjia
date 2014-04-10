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
    
    public function getByEmail($email) {
        try {
            $result = $this->find ( "email='{$email}'" );
            return $result;
        } catch ( Exception $e ) {
            echo $e;
        }
    }
    
    public function getByTel($tel) {
        try {
            $result = $this->find ( "tel='{$tel}'" );
            return $result;
        } catch ( Exception $e ) {
            echo $e;
        }
    }
}