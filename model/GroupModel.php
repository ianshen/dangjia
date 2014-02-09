<?php
class GroupModel extends Cola_Model {
    
    protected $_table = 'group';
    
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