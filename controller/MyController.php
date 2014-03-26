<?php
class MyController extends BaseController {
    
    /**
     * 我的首页
     */
    public function indexAction() {
        //获取我的圈子(我的群组)===是否存入SESSION?
        $uid = $_SESSION ['uid'];
        $myGroups = UserGroupData::getsGroupByUID ( $uid );
        $this->assign ( 'groups', $myGroups );
        $this->display ();
    }
    
    /**
     * 我的订单
     */
    public function orderAction() {
    
    }
    
    /**
     * 我的圈子
     */
    public function groupAction() {
    
    }
    
    /**
     * 我的财富
     */
    public function propertyAction() {
    
    }
    
    /**
     * 我的积分（积分以penny形式表示，penny=角）
     */
    public function pennyAction() {
    
    }
    
    /**
     * 我的信息
     */
    public function infoAction() {
    
    }
    
    /**
     * 更改密码
     */
    public function passAction() {
    
    }
    
    /**
     * 我的地址
     */
    public function addrAction() {
    
    }

}