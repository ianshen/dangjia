<?php
class IndexController extends BaseController {
    
    public function indexAction() {
    
    }
    
    /**
     * 单个用户个人信息聚合页
     */
    public function pageAction() {
        //获取用户信息
    //获取用户订单
    //获取用户说说
    //获取用户团购
    }
    
    /**
     * 登录
     */
    public function loginAction() {
        //登录可使用邮箱和手机，系统自动判断登录号类型
        $type = $this->param ( 'type' );
        $pass = trim ( $this->param ( 'pass' ) );
        //合法性检查
        switch ($type) {
            case 'tel' :
                $tel = trim ( $this->param ( 'tel' ) );
                //合法性检查
                $user = UserData::getByTel ( $tel );
                break;
            case 'email' :
                $email = trim ( $this->param ( 'email' ) );
                //合法性检查
                $user = UserData::getByEmail ( $email );
                break;
        }
        if (empty ( $user ) || $pass != $user ['pass']) {
            ComTool::ajax ( 100001, '帐号或密码错误' );
        }
    
    }
    
    /**
     * 注册
     */
    public function regAction() {
        //注册时必填邮箱和手机
        if (ComTool::isAjax ()) {
            $captcha = trim ( $this->param ( 'captcha' ) );
            $email = trim ( $this->param ( 'email' ) );
            //检查邮箱唯一性
            $tel = trim ( $this->param ( 'tel' ) );
            //检查手机唯一性
            $name = trim ( $this->param ( 'name' ) ); //姓名或代号
            $pass = trim ( $this->param ( 'pass' ) );
            $pass2 = trim ( $this->param ( 'pass2' ) );
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
}