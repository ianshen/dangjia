<?php
/**
 * 帐号登录、注册
 * @author Administrator
 *
 */
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
            $acc = trim ( $this->post ( 'user' ) );
            $passwd = trim ( $this->post ( 'passwd' ) );
            $rememberme = trim ( $this->post ( 'rememberme' ) );
            //合法性检查
            if (! $acc || ! $passwd) {
                ComTool::ajax ( 100001, '请填写帐号或密码' );
            }
            ComTool::checkMaxLen ( $acc, 32, '帐号最多32位' );
            if (! ComTool::isEmail ( $acc ) && ! ComTool::isMobile ( $acc )) {
                ComTool::ajax ( 100001, '请填写正确的邮箱或手机号' );
            }
            ComTool::checkMinMaxLen ( $passwd, 6, 16, '密码6-16位' );
            if (ComTool::isEmail ( $acc )) {
                $user = UserData::getByEmail ( $acc );
            } elseif (ComTool::isMobile ( $acc )) {
                $user = UserData::getByTel ( $acc );
            } else {
                ComTool::ajax ( 100001, '请填写正确的邮箱或手机号' );
            }
            if (empty ( $user ) || md5 ( $passwd ) != $user ['passwd']) {
                ComTool::ajax ( 100001, '帐号或密码错误' );
            }
            //记住我一个月
            if (! empty ( $rememberme ) && $rememberme == 'on') {
                exit ( 'x' );
            }
            //成功则写session
            $_SESSION ['islogin'] = 1; //登录标识
			//登录用户信息
			$_SESSION ['user'] = array (
				'id' => $user ['id'], 
				'mobile' => $user ['mobile'], 
				'email' => $user ['email'], 
				'passwd' => $user ['passwd'], 
				'name' => $user ['name'] 
			);
            $returnUrl = trim ( $this->post ( 'returnUrl' ) );
            $returnUrl = $returnUrl ? $returnUrl : $this->urlroot . 'my/group';
            ComTool::ajax ( 100000, '登录成功，即将跳转', $returnUrl );
        }
        if ($this->isLogin ()) {
            $returnUrl = ComTool::urlRoot ();
            //Cola_Response::redirect ( $returnUrl );
        }
        $returnUrl = urldecode ( $this->get ( 'returnUrl', '' ) );
        $this->assign ( 'returnUrl', $returnUrl );
        $this->display ();
    }
    
    /**
     * 注册
     */
    public function regAction() {
        //注册时必填邮箱和手机
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
            if ($user) {
                ComTool::ajax ( 100001, '邮箱已被注册' );
            }
            $mobile = trim ( $this->post ( 'mobile' ) );
            ComTool::checkEmpty ( $mobile, '请填写常用手机号' );
            if (! ComTool::isMobile ( $mobile )) {
                ComTool::ajax ( 100001, '请填写正确的手机号' );
            }
            //检查手机唯一性
            $user = UserData::getByMobile ( $mobile );
            if ($user) {
                ComTool::ajax ( 100001, '手机号已被注册' );
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
            //$name = trim ( $this->post ( 'name' ) ); //姓名或代号
            $passwd = trim ( $this->post ( 'passwd' ) );
            ComTool::checkEmpty ( $passwd, '请输入密码' );
            ComTool::checkMinMaxLen ( $passwd, 6, 16, '密码6-16位' );
            $cpasswd = trim ( $this->post ( 'cpasswd' ) );
            ComTool::checkEqual ( $passwd, $cpasswd, '两次输入的密码不同' );
            $res = UserData::add ( array (
                'email' => $email, 
                'mobile' => $mobile, 
                'passwd' => md5 ( $passwd ), 
                'create_time' => time (), 
                'update_time' => time (), 
                'status' => 1 
            ) );
            if ($res === false) {
                ComTool::ajax ( 100001, '服务器忙，请重试' );
            }
            $res = UserGroupData::add ( array (
                'user_id' => $res, 
                'group_id' => $group, 
                'detail' => $addr_desc, 
                'status' => 1 
            ) );
            ComTool::result ( $res, '服务器忙，请重试', '注册成功' );
        }
        if ($this->isLogin ()) {
            $returnUrl = ComTool::urlRoot ();
            //Cola_Response::redirect ( $returnUrl );
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
            $this->assign ( 'list', $locations );
            $this->assign ( 'type', $this->get ( 'type' ) );
            $html = $this->fetch ( "Index/layer/select.html" );
            ComTool::ajax ( 100000, 'ok', $html );
        }
    }
    
    /**
     * 获取圈子信息
     */
    public function getgroupAction() {
        if (ComTool::isAjax ()) {
            $ajax = $this->get ( 'ajax' );
            $field = $this->get ( 'f' );
            $id = intval ( $this->get ( 'id', 0 ) );
            if (empty ( $id )) {
                ComTool::ajax ( 100001, 'wrong id' );
            }
            $group = GroupData::getById ( $id );
            if (! $group) {
                ComTool::ajax ( 100001, 'wrong id' );
            }
            ComTool::ajax ( 100000, 'ok', $group [$field] );
        }
    }
    
    /**
     * 获取分类信息
     */
    public function getcategoryAction() {
        if (ComTool::isAjax ()) {
            $ajax = $this->get ( 'ajax' );
            $ctype = $this->get ( 'ctype' );
            $id = intval ( $this->get ( 'id', 0 ) );
            if (empty ( $id )) {
                ComTool::ajax ( 100001, 'wrong gid' );
            }
            if ($ctype == 'p') {
                $cats = CategoryData::getl1CatsByGid ( $id );
            } elseif ($ctype == 'c') {
                $cats = CategoryData::getl2CatsByPid ( $id );
            }
            $this->assign ( 'list', $cats );
            $this->assign ( 'type', $this->get ( 'type' ) );
            $html = $this->fetch ( "Index/layer/select.html" );
            ComTool::ajax ( 100000, 'ok', $html );
        }
    }
    
    /**
     * 验证码
     */
    public function captchaAction() {
        $captcha = new Cola_Ext_Captcha ();
        $captcha->display ();
    }
}