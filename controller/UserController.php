<?php
class UserController extends BaseController {
    
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
        if (ComTool::isAjax ()) {
            //登录可使用邮箱和手机，系统自动判断登录号类型
            $type = $this->post ( 'type' );
            $pass = trim ( $this->post ( 'pass' ) );
            //合法性检查
            switch ($type) {
                case 'tel' :
                    $tel = trim ( $this->post ( 'tel' ) );
                    //合法性检查
                    $user = UserData::getByTel ( $tel );
                    break;
                case 'email' :
                    $email = trim ( $this->post ( 'email' ) );
                    //合法性检查
                    $user = UserData::getByEmail ( $email );
                    break;
            }
            if (empty ( $user ) || $pass != $user ['pass']) {
                ComTool::ajax ( 100001, '帐号或密码错误' );
            }
            ComTool::ajax ( 100000, 'ok' );
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
            //检查邮箱唯一性
            $tel = trim ( $this->post ( 'tel' ) );
            //检查手机唯一性
            $name = trim ( $this->post ( 'name' ) ); //姓名或代号
            $pass = trim ( $this->post ( 'pass' ) );
            $pass2 = trim ( $this->post ( 'pass2' ) );
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
            $id = $this->get ( 'id', 0 );
            $type = $this->get ( 't', 'c' ); //当前id的类型 city/area
            $locations = array ();
            $tpl = '';
            if ($type == 'c') {
                //获取某城市下区域
                $locations = RegionData::getsByPid ( $id );
                $tpl = '';
            } elseif ($type == 'a') {
                //获取某区域的圈子
                $locations = GroupData::getsByRid ( $id );
                $tpl = '';
            }
            if (! $locations) {
                ComTool::ajax ( 100001, 'wrong params' );
            }
            $this->assign ( 'locations', $locations );
            $html = $this->fetch ( $tpl );
            ComTool::ajax ( 100000, 'ok', $html );
        }
    }
}