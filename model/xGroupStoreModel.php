<?php
class GroupStoreModel extends BaseModel {
    
    protected $_table = 'group_store';
    
    public function getsByGid($gid) {
        try {
            $result = $this->find ( "group_id='{$gid}'" );
            return $result;
        } catch ( Exception $e ) {
            echo $e;
        }
    }
}