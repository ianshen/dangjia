<?php
class UserModel extends Cola_Model {
    
    protected $_table = 'test1';
    
    public function test() {
        try {
            $result = $this->sql ( "select * from test1 limit 5;" );
            return $result;
        } catch ( Exception $e ) {
            echo $e;
        }
    }
    
    public function getById($id) {
        try {
            $result = $this->find ( "id={$id}" );
            return $result;
        } catch ( Exception $e ) {
            echo $e;
        }
    }
    
    public function del() {
    
    }
    
    public function add() {
    
    }
    
    public function update() {
    
    }
}