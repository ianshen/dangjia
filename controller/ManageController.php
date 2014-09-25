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
        $currUser = $this->getCurrentUser ();
        $this->assign ( 'currUser', $currUser );
        $this->display ();
    }
    
    public function orderAction() {
        $this->display ();
    }
    
    public function infoAction() {
        $this->display ();
    }
}