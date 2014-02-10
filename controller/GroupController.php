<?php
class GroupController extends BaseController {
    
    public function indexAction() {
        $gid = $this->param ( 'gid' );
        //根据群组id取附近的店铺资源
        $ids = GroupStoreData::getStoreIdsByGid ( $gid );
        if (! $ids) {
            exit ( '群组内暂无资源' );
        }
        $ids = join ( ',', $ids );
        //获取店铺资源详细信息
        $stores = StoreData::getsByIds ( $ids );
        print_r ( $stores );
        $this->display ();
    }
}