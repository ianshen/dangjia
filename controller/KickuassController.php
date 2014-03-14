<?php
class KickuassController extends BaseController {
    
    public function indexAction() {
        $url = ComTool::url ( 'kickuass/cate', array () );
        $this->display ();
    }
    
    /**
     * 添加群组
     */
    public function groupAction() {
        if (ComTool::isAjax ()) {
            ComTool::validToken ();
            $name = trim ( $this->post ( 'name' ) );
            ComTool::checkEmpty ( $name, '群组名不能为空' );
            $ename = trim ( $this->post ( 'ename' ) );
            ComTool::checkEmpty ( $ename, '群组拼音不能为空' );
            $status = $this->post ( 'status' );
            $res = GroupData::add ( array (
                'name' => $name, 
                'ename' => $ename, 
                'status' => $status, 
                'create_time' => time (), 
                'create_date' => date ( 'Y-m-d' ) 
            ) );
            ComTool::result ( $res );
        }
        $groups = GroupData::getsAll ();
        $this->assign ( 'list', $groups );
        $this->display ();
    }
    
    /**
     * 添加店铺
     */
    public function storeAction() {
        if (ComTool::isAjax ()) {
            exit ();
        }
        $stores = StoreData::getsAll ();
        $this->assign ( 'stores', $stores );
        $this->display ();
    }
    
    /**
     * 添加分类
     */
    public function cateAction() {
        if (ComTool::isAjax ()) {
            $group = $this->post ( 'group' );
            $store = $this->post ( 'store' );
            $level = $this->post ( 'level' );
            $parent = $this->post ( 'parent' );
            $name = $this->post ( 'name' );
            $ename = $this->post ( 'ename' );
            $desc = $this->post ( 'desc' );
            $limit = $this->post ( 'limit' );
            $days = $this->post ( 'day' );
            $start = $this->post ( 'start' );
            $end = $this->post ( 'end' );
            $status = $this->post ( 'status' );
            $data = array ();
            $data ['group_id'] = $group;
            $data ['store_id'] = $store;
            $data ['level'] = $level;
            $data ['pid'] = $parent;
            $data ['name'] = $name;
            $data ['ename'] = $ename;
            $data ['desc'] = $desc;
            $data ['create_time'] = '';
            $data ['update_time'] = '';
            $data ['time_limit'] = $limit;
            $data ['days'] = $days;
            $data ['start_time'] = $start;
            $data ['end_time'] = $end;
            $data ['status'] = $status;
            $res = CategoryData::add ( $data );
            ComTool::result ( $res );
        }
        $groups = GroupData::getsAll ();
        $stores = StoreData::getsAll ();
        $this->assign ( 'groups', $groups );
        $this->assign ( 'stores', $stores );
        $this->display ();
    }
}