<?php
class ManageController extends BaseController {
    
    protected $mustLogin = 1;
    
    public function __construct() {
        parent::__construct ();
        $this->mustLoginCheck ();
    }
    
    protected function isLogin() {
        return isset ( $_SESSION ['manage_islogin'] ) && $_SESSION ['manage_islogin'] ? true : false;
    }
    
    protected function getCurrentUser() {
        return isset ( $_SESSION ['manage_user'] ) && $_SESSION ['manage_user'] ? $_SESSION ['manage_user'] : array ();
    }
    
    protected function refreshCurrentUser() {
        $currUser = $this->getCurrentUser ();
        $sql = "SELECT * FROM `store` WHERE `ename`='{$currUser ['ename']}' limit 1";
        $currUser = BaseData::sql ( $sql );
        if (! $currUser) {
            $_SESSION ['manage_islogin'] = 0;
            $_SESSION ['manage_user'] = array ();
        }
        $_SESSION ['manage_user'] = $currUser [0];
        return $currUser [0];
    }
    
    /**
     * 必须登录检查，若未登录跳转至登录页
     */
    protected function mustLoginCheck() {
        if ($this->mustLogin) {
            if (! $this->isLogin ()) {
                if (ComTool::isAjax ()) {
                    exit ( 'not login' );
                } else {
                    $token = trim ( $this->get ( 'token', '' ) );
                    Cola_Response::redirect ( ComTool::url ( "acc/manage_login?token={$token}" ) );
                }
            }
        }
    }
    
    /**
     * 
     */
    public function indexAction() {
        $currUser = $this->refreshCurrentUser ();
        $this->assign ( 'currUser', $currUser );
        $this->display ();
    }
    
    public function passwordAction() {
        $currUser = $this->refreshCurrentUser ();
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
            ComTool::checkEqual ( md5 ( $curpass ), $currUser ['passwd'], '当前登录密码错误，请检查' );
            $passwd = trim ( $this->post ( 'passwd' ) );
            ComTool::checkEmpty ( $passwd, '请输入新登录密码' );
            ComTool::checkMinMaxLen ( $passwd, 6, 16, '密码6-16位' );
            $cpasswd = trim ( $this->post ( 'cpasswd' ) );
            ComTool::checkEqual ( $passwd, $cpasswd, '两次输入的新密码不同' );
            $passwd = md5 ( $passwd );
            $time = time ();
            $sql = "update `store` set passwd='{$passwd}',update_time='{$time}' where id={$currUser ['id']} limit 1";
            $res = BaseData::sql ( $sql );
            ComTool::result ( $res, '服务器忙，请重试', '保存成功' );
        }
        $this->display ();
    }
    
    public function orderAction() {
        $currUser = $this->refreshCurrentUser ();
        //店铺支撑的品类
        $sql = "select * from `category` where store_id='{$currUser['id']}'";
        $categorys = BaseData::sql ( $sql );
        print_r ( $categorys );
        $this->assign ( 'categorys', $categorys );
        $this->display ();
    }
}