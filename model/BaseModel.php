<?php
class BaseModel extends Cola_Model {
    
    /**
     * 表名要加``号以免和系统命令冲突
     * @var unknown_type
     */
    protected $_table = '';
    
    public function del($id) {
        try {
            $result = $this->delete ( $id );
            return $result;
        } catch ( Exception $e ) {
            echo $e;
        }
    }
    
    public function add($data) {
        try {
            $result = $this->insert ( $data );
            return $result;
        } catch ( Exception $e ) {
            echo $e;
        }
    }
    
    public function modify($id, $data) {
        try {
            $result = $this->update ( $id, $data );
            return $result;
        } catch ( Exception $e ) {
            echo $e;
        }
    }
}