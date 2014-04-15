<?php
class CategoryData extends BaseData {
    
    static function getsByIds($ids) {
        if (! $ids) {
            return false;
        }
        $model = new CategoryModel ();
        $result = $model->getsByIds ( $ids );
        return $result;
    }
    
    static function getById($cid) {
        if (! $cid) {
            return false;
        }
        $model = new CategoryModel ();
        $result = $model->getById ( $cid );
        if (! $result) {
            return false;
        }
        return $result [0];
    }
    
    /**
     * get level 1 categorys by gid
     * @param unknown_type $cid
     * @return boolean|Ambigous <>
     */
    static function getl1CatsByGid($gid) {
        if (! $gid) {
            return false;
        }
        $model = new CategoryModel ();
        $result = $model->getl1CatsByGid ( $gid );
        if (! $result) {
            return false;
        }
        return $result;
    }
    /**
     * get level 2 categorys by pid
     * @param unknown_type $cid
     * @return boolean|Ambigous <>
     */
    static function getl2CatsByPid($pid) {
        if (! $pid) {
            return false;
        }
        $model = new CategoryModel ();
        $result = $model->getl2CatsByPid ( $pid );
        if (! $result) {
            return false;
        }
        return $result;
    }
    
    static function getParents() {
        $model = new CategoryModel ();
        $result = $model->getParents ();
        return $result;
    }
    /**
     * 组织某个群组的分类数据
     * @param unknown_type $gid
     * @return boolean|Ambigous <multitype:multitype: , unknown>
     */
    static function groupCategorys($gid) {
        if (! $gid) {
            return false;
        }
        $model = new CategoryModel ();
        $result = $model->getsByGId ( $gid );
        if (! $result) {
            return false;
        }
        $root = array ();
        foreach ( $result as $k => $cat ) {
            if ($cat ['pid'] == 0 && $cat ['level'] == 1) {
                $cat ['children'] = array ();
                $root [$cat ['id']] = $cat;
                unset ( $result [$k] );
            }
        }
        if (! $result) {
            return false;
        }
        foreach ( $result as $k => $cat ) {
            $root [$cat ['pid']] ['children'] [] = $cat;
        }
        return $root;
    }
    
    static function getsAll() {
        $model = new CategoryModel ();
        $result = $model->getsAll ();
        return $result;
    }
    
    static function del() {
    
    }
    
    static function add($data) {
        if (! $data) {
            return false;
        }
        $model = new CategoryModel ();
        $result = $model->add ( $data );
        return $result;
    }
    
    static function modify() {
    
    }
}