<?php
class BaseModel extends Cola_Model {
    
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