<?php
class GroupStoreModel extends Cola_Model {
    
    protected $_table = 'group_store';
    
    public function getsByGid($gid) {
        try {
            $result = $this->find ( "group_id='{$gid}'" );
            return $result;
        } catch ( Exception $e ) {
            echo $e;
        }
    }
    
    public function del() {
    
    }
    
    public function add() {
    
    }
    
    public function modify() {
    
    }
}