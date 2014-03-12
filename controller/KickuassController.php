<?php
class KickuassController extends BaseController {
    
    public function indexAction() {
        $this->display ();
    }
    
    /**
     * 添加群组
     */
    public function groupAction() {
        //print_r($_SERVER);
        //$url = ComTool::url ( 'kickuass/cate', array () );
        //print_r ( $url );
        if (ComTool::isAjax ()) {
            $b=ComTool::checkToken ();
            var_dump($b);exit;
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
            if ($res === false) {
                ComTool::ajax ( 100001, 'error' );
            }
            ComTool::ajax ();
        }
        $token = ComTool::buildToken ();
        $this->assign ( 'token', $token );
        $groups = GroupData::getsAll ();
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
            if ($res === false) {
                ComTool::ajax ( 100001, 'error' );
            }
            ComTool::ajax ();
        }
        $token = ComTool::buildToken ();
        $this->assign ( 'token', $token );
        $this->display ();
    }
    
    public function storeAction() {
        if (ComTool::isAjax ()) {
            exit ();
        }
        $this->display ();
    }
}