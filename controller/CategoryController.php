<?php
class CategoryController extends BaseController {
    
    public function indexAction() {
        $this->display ();
    }
    
    /**
     * 添加分类
     */
    public function addAction() {
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
        $res = CategoryData::add ( $data );
    }
}