<?php
/**
 * 设置
 * @author Administrator
 *
 */
class SettingsController extends BaseController {
    
    protected $mustLogin = 1;
    
    public function __construct() {
        parent::__construct ();
        $this->mustLoginCheck ();
    }
    
    public function indexAction() {
        $currUser = $this->refreshCurrentUser ();
        //$currUser = $this->getCurrentUser ();
        if (ComTool::isAjax ()) {
            if (isset ( $_POST ['captcha'] )) {
                $captcha = trim ( $this->post ( 'captcha' ) );
                if (! ComTool::checkCaptcha ( $captcha )) {
                    ComTool::ajax ( 100001, '验证码错误' );
                }
            }
            $email = trim ( $this->post ( 'email' ) );
            ComTool::checkEmpty ( $email, '请填写常用邮箱' );
            ComTool::checkMaxLen ( $email, 32, '邮箱最多32位' );
            if (! ComTool::isEmail ( $email )) {
                ComTool::ajax ( 100001, '请填写正确的邮箱' );
            }
            //检查邮箱唯一性
            $user = UserData::getByEmail ( $email );
            if ($user && $user ['id'] != $currUser ['id']) {
                ComTool::ajax ( 100001, '邮箱已被占用' );
            }
            $mobile = trim ( $this->post ( 'mobile' ) );
            ComTool::checkEmpty ( $mobile, '请填写常用手机号' );
            if (! ComTool::isMobile ( $mobile )) {
                ComTool::ajax ( 100001, '请填写正确的手机号' );
            }
            //检查手机唯一性
            $user = UserData::getByMobile ( $mobile );
            if ($user && $user ['id'] != $currUser ['id']) {
                ComTool::ajax ( 100001, '手机号已被占用' );
            }
            $name = trim ( $this->post ( 'name' ) );
            ComTool::checkMaxLen ( $name, 16, "名称最多16位" );
            $res = UserData::modify ( $currUser ['id'], array (
                'name' => $name, 
                'email' => $email, 
                'mobile' => $mobile, 
                'update_time' => time () 
            ) );
            ComTool::result ( $res, '服务器忙，请重试', '保存成功' );
        }
        $this->assign ( "currUser", $currUser );
        $this->display ();
    }
    
    public function passwordAction() {
        $currUser = $this->getCurrentUser ();
        if (ComTool::isAjax ()) {
            if (isset ( $_POST ['captcha'] )) {
                $captcha = trim ( $this->post ( 'captcha' ) );
                if (! ComTool::checkCaptcha ( $captcha )) {
                    ComTool::ajax ( 100001, '验证码错误' );
                }
            }
            $curpass = trim ( $this->post ( 'curpass' ) );
            ComTool::checkEmpty ( $curpass, '请输入当前密码' );
            ComTool::checkMinMaxLen ( $curpass, 6, 16, '密码6-16位' );
            ComTool::checkEqual ( md5 ( $curpass ), $currUser ['passwd'], '当前密码错误，请检查' );
            $passwd = trim ( $this->post ( 'passwd' ) );
            ComTool::checkEmpty ( $passwd, '请输入新密码' );
            ComTool::checkMinMaxLen ( $passwd, 6, 16, '密码6-16位' );
            $cpasswd = trim ( $this->post ( 'cpasswd' ) );
            ComTool::checkEqual ( $passwd, $cpasswd, '两次输入的密码不同' );
            $res = UserData::modify ( $currUser ['id'], array (
                'passw' => md5 ( $passwd ), 
                'update_time' => time () 
            ) );
            ComTool::result ( $res, '服务器忙，请重试', '保存成功' );
        }
        $this->display ();
    }
    
    public function groupAction() {
        $currUser = $this->getCurrentUser ();
        if (ComTool::isAjax ()) {
        
        }
        $myGroups = UserGroupData::getsGroupByUID ( $currUser ['id'] );
        if ($myGroups) {
            $gids = array ();
            foreach ( $myGroups as $group ) {
                $gids [] = $group ['group_id'];
            }
            $gids = join ( ',', $gids );
            $groups = GroupData::dataByWhere ( "id in ({$gids})" );
            foreach ( $myGroups as &$group ) {
                $group ['name'] = $groups [$group ['group_id']] ['name'];
            }
        }
        $_SESSION ['groups'] = $myGroups;
        $this->assign ( 'myGroups', $myGroups );
        $this->display ();
    }
    
    /**
     * 设置user_group的detail详细地址信息
     */
    public function setaddrdescAction() {
        if (ComTool::isAjax ()) {
            $gid = intval ( $this->post ( 'gid', 0 ) );
            ComTool::checkEmpty ( $gid, "操作失败，请刷新重试" );
            $detail = trim ( $this->post ( 'detail', '' ) );
            ComTool::checkMaxLen ( $detail, 32, "详细位置最多32位" );
            $currUser = $this->getCurrentUser ();
            $uid = $currUser ['id'];
            $sql = "update user_group set `detail`='{$detail}' where user_id='{$uid}' and group_id='{$gid}'";
            $res = UserGroupData::sql ( $sql );
            ComTool::result ( $res, '操作失败，请刷新重试', '操作成功' );
        }
    }
    
    /**
     * 加入圈子
     */
    public function joingroupAction() {
        if (ComTool::isAjax ()) {
            if (isset ( $_POST ['captcha'] )) {
                $captcha = trim ( $this->post ( 'captcha' ) );
                if (! ComTool::checkCaptcha ( $captcha )) {
                    ComTool::ajax ( 100001, '验证码错误' );
                }
            }
            $city = trim ( $this->post ( 'city' ) );
            ComTool::checkEmpty ( $city, '请选择城市' );
            $area = trim ( $this->post ( 'area' ) );
            ComTool::checkEmpty ( $area, '请选择区域' );
            $group = trim ( $this->post ( 'group' ) );
            ComTool::checkEmpty ( $group, '请选择圈子' );
            $addr_desc = trim ( $this->post ( 'addr_desc' ) );
            ComTool::checkEmpty ( $addr_desc, '请填写详细位置' );
            ComTool::checkMaxLen ( $addr_desc, 32, '详细位置最多32位' );
            $currUser = $this->getCurrentUser ();
            $groupsNumLimit = Cola::getConfig ( '_groupsNumLimit' );
            $groups = UserGroupData::getsGroupByUID ( $currUser ['id'] );
            foreach($groups as $v){
                if ($group == $v ['group_id']) {
                    ComTool::ajax ( 100001, '你已加入该圈子' );
                }
            }
            if (count ( $groups ) > $groupsNumLimit) {
                ComTool::ajax ( 100001, '你加入的圈子超过最大限制' );
            }
            $res = UserGroupData::add ( array (
                'user_id' => $currUser ['id'], 
                'group_id' => $group, 
                'detail' => $addr_desc 
            ) );
            ComTool::result ( $res, '操作失败，请刷新重试', '操作成功' );
        }
    }
    
    /**
     * 退出圈子
     */
    public function quitgroupAction() {
        if (ComTool::isAjax ()) {
            $gid = intval ( $this->post ( 'gid', 0 ) );
            ComTool::checkEmpty ( $gid, "操作失败，请刷新重试" );
            $currUser = $this->getCurrentUser ();
            $sql = "delete from user_group where user_id='{$currUser ['id']}' and group_id='{$gid}'";
            $res = UserGroupData::sql ( $sql );
            ComTool::result ( $res, '操作失败，请刷新重试', '操作成功' );
        }
    }
}