<?php
class GroupModel extends BaseModel {
    
    protected $_table = '`group`';
    
    public function getById($id) {
        try {
            $result = $this->find ( "id='{$id}'" );
            return $result;
        } catch ( Exception $e ) {
            echo $e;
        }
    }
    
    public function getsByRid($rid) {
        try {
            $result = $this->find ( "region_id='{$rid}'" );
            return $result;
        } catch ( Exception $e ) {
            echo $e;
        }
    }
    
    public function getsAll() {
        try {
            $result = $this->find ();
            return $result;
        } catch ( Exception $e ) {
            echo $e;
        }
    }
}