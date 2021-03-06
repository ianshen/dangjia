<?php
class CategoryModel extends BaseModel {
    
    protected $_table = '`category`';
    
    public function getsByGid($gid) {
        try {
            $result = $this->find ( "group_id='{$gid}' and `status`='1'" );
            return $result;
        } catch ( Exception $e ) {
            echo $e;
        }
    }
    
    public function getById($id) {
        try {
            $result = $this->find ( "id='{$id}' and `status`='1'" );
            return $result;
        } catch ( Exception $e ) {
            echo $e;
        }
    }
    
    public function getParents() {
        try {
            $result = $this->find ( 'pid=0' );
            return $result;
        } catch ( Exception $e ) {
            echo $e;
        }
        return $result;
    }
    
    /**get level 1 cats
     * @param unknown_type $gid
     * @return Ambigous <multitype:, boolean, unknown>
     */
    public function getl1CatsByGid($gid) {
        try {
            $result = $this->find ( "group_id={$gid} and pid=0" );
            return $result;
        } catch ( Exception $e ) {
            echo $e;
        }
        return $result;
    }
    
    public function getl2CatsByPid($pid) {
        try {
            $result = $this->find ( "pid={$pid}" );
            return $result;
        } catch ( Exception $e ) {
            echo $e;
        }
        return $result;
    }

}