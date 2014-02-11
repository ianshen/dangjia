<?php
class GroupModel extends BaseModel {
    
    protected $_table = 'group';
    
    public function getById($id) {
        try {
            $result = $this->find ( "id='{$id}'" );
            return $result;
        } catch ( Exception $e ) {
            echo $e;
        }
    }
}