<?php
class StoreController extends BaseController {
    
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
    
    public function indexAction() {
        $this->display ();
    }
}