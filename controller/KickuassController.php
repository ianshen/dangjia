<?php
class KickuassController extends BaseController {
    
    public function indexAction() {
        $groups = '';
        $groups = GroupData::getsAll ();
        //$this->view ()->id = '3ss';
        $this->assign ( 'list', $groups );
        $this->display ();
    }
    
    /**
     * 添加群组
     */
    public function groupAction() {
        if (ComTool::isAjax ()) {
            ComTool::ajaxRender ();
        }
        $groups = '';
        $this->assign ( 'list', $groups );
        $this->display ();
    }
    
    /**
     * 添加分类
     */
    public function cateAction() {
        if (ComTool::isAjax ()) {
            $gid = $this->post ( 'gid' );
            $sid = $this->post ( 'sid' );
            $level = $this->post ( 'level' );
            $pid = $this->post ( 'pid' );
            $name = $this->post ( 'name' );
            $data = array ();
            $data ['group_id'] = '';
            $data ['store_id'] = '';
            $data ['level'] = '';
            $data ['pid'] = '';
            $data ['name'] = '';
            $data ['create_time'] = '';
            $data ['update_time'] = '';
            $data ['time_limit'] = '';
            $data ['start_time'] = '';
            $data ['end_time'] = '';
            $data ['status'] = '';
            exit ();
            $res = CategoryData::add ( $data );
        }
        $this->display ();
    }
    
    public function storeAction() {
        if (ComTool::isAjax ()) {
            exit ();
        }
        $this->display ();
    }
}