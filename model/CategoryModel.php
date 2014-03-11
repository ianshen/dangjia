<?php
class CategoryModel extends BaseModel {
    
    protected $_table = '`category`';
    
    public function getsByGid($gid) {
        try {
            $result = $this->find ( "group_id='{$gid}'" );
            return $result;
        } catch ( Exception $e ) {
            echo $e;
        }
    }
}