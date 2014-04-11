<?php
class AccController extends BaseController {
    
    public function indexAction() {
        $this->display ();
    }
    
    /**
     * 登录
     */
    public function loginAction() {
        if (ComTool::isAjax ()) {
            //登录可使用邮箱和手机，系统自动判断登录号类型
            $type = $this->post ( 'type' );
            $user = trim ( $this->post ( 'user' ) );
            $passwd = trim ( $this->post ( 'passwd' ) );
            $rememberme = trim ( $this->post ( 'rememberme' ) );
            //合法性检查
            if (! $user || ! $passwd) {
                ComTool::ajax ( 100001, '请填写帐号或密码' );
            }
            ComTool::checkMaxLen ( $user, 32, '帐号最多32位' );
            if (! ComTool::isEmail ( $user ) && ! ComTool::isMobile ( $user )) {
                ComTool::ajax ( 100001, '请填写正确的邮箱或手机号' );
            }
            ComTool::checkMinMaxLen ( $passwd, 6, 16, '密码6-16位' );
            if (ComTool::isEmail ( $user )) {
                $user = UserData::getByEmail ( $user );
            } elseif (ComTool::isMobile ( $user )) {
                $user = UserData::getByTel ( $user );
            } else {
                ComTool::ajax ( 100001, '请填写正确的邮箱或手机号' );
            }
            if (empty ( $user ) || $passwd != $user ['passwd']) {
                ComTool::ajax ( 100001, '帐号或密码错误' );
            }
            //记住我一个月
            if (! empty ( $rememberme ) && $rememberme == 'on') {
                exit ( 'x' );
            }
            //成功则写session
            $_SESSION ['islogin'] = 1;
            $_SESSION ['user'] = $user;
            $returnUrl = '';
            /* $returnUrl = trim ( $this->post ( 'returnUrl' ) );
            $returnUrl = $returnUrl ? $returnUrl : ''; */
            ComTool::ajax ( 100000, 'ok', $returnUrl );
        }
        $this->display ();
    
    }
    
    /**
     * 注册
     */
    public function regAction() {
        //注册时必填邮箱和手机
        if (ComTool::isAjax ()) {
            $captcha = trim ( $this->post ( 'captcha' ) );
            $email = trim ( $this->post ( 'email' ) );
            ComTool::checkEmpty ( $email, '请填写邮箱' );
            ComTool::checkMaxLen ( $email, 32, '邮箱最多32位' );
            if (! ComTool::isEmail ( $email )) {
                ComTool::ajax ( 100001, '请填写正确的邮箱' );
            }
            //检查邮箱唯一性
            $mobile = trim ( $this->post ( 'mobile' ) );
            ComTool::checkEmpty ( $mobile, '请填写邮箱' );
            if (! ComTool::isMobile ( $mobile )) {
                ComTool::ajax ( 100001, '请填写正确的手机号' );
            }
            //检查手机唯一性
            $city = trim ( $this->post ( 'city' ) );
            $area = trim ( $this->post ( 'area' ) );
            $group = trim ( $this->post ( 'group' ) );
            $addr_desc = trim ( $this->post ( 'addr_desc' ) );
            $name = trim ( $this->post ( 'name' ) ); //姓名或代号
            $passwd = trim ( $this->post ( 'passwd' ) );
            ComTool::checkMinMaxLen ( $passwd, 6, 16, '密码6-16位' );
            $cpasswd = trim ( $this->post ( 'cpasswd' ) );
            ComTool::checkEqual ( $passwd, $cpasswd, '两次输入密码不同' );
        }
        $this->display ();
    }
    
    /**
     * 退出
     */
    public function logoutAction() {
        $_SESSION = array ();
        session_unset ();
        session_destroy ();
        $url = ComTool::url ( "index" );
        header ( "Location:{$url}" );
    }
    
    /**
     * ajax获取地区信息
     */
    public function getlocationAction() {
        if (ComTool::isAjax ()) {
            $ajax = $this->get ( 'ajax' );
            $id = intval ( $this->get ( 'id', 0 ) );
            $type = $this->get ( 't', 'c' ); //当前id的类型 city/area
            $locations = array ();
            if ($type == 'c') {
                //获取某城市下区域
                $locations = RegionData::getsByPid ( $id );
            } elseif ($type == 'a') {
                //获取某区域的圈子
                $locations = GroupData::getsByRid ( $id );
            }
            if (! $locations) {
                //ComTool::ajax ( 100001, 'wrong params' );
            }
            $this->assign ( 'locations', $locations );
            $html = $this->fetch ( "Index/layer/region.html" );
            ComTool::ajax ( 100000, 'ok', $html );
        }
    }
}