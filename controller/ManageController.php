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
        //该店铺支撑的品类
        $sql = "select * from `category` where store_id='{$currUser['id']}'";
        $groupIds = array ();
        $categorys = BaseData::sql ( $sql );
        if ($categorys) {
            foreach ( $categorys as $category ) {
                $groupIds [] = $category ['group_id'];
            }
            $groupIds = array_unique ( $groupIds );
            $groupIds = join ( ',', $groupIds );
            $sql = "select * from `group` where id in({$groupIds})";
            $groups = BaseData::sql ( $sql );
            foreach ( $groups as $group ) {
                $tmp [$group ['id']] = $group;
            }
            $groups = $tmp;
            foreach ( $categorys as $k => $category ) {
                $categorys [$k] ['group'] = $groups [$category ['group_id']];
            }
        }
        $this->assign ( 'categorys', $categorys );
        $this->display ();
    }
    
    public function order_detailAction() {
        $cid = $this->param ( 'c', '' );
        $type = $this->param ( 't', '' );
        $details = array ();
        if ($cid) {
            $currUser = $this->refreshCurrentUser ();
            $cid = ComTool::escape ( $cid );
            $createDate = date ( "Y-m-d" );
            $sql = "SELECT a.id,a.user_id,a.category_id,a.user_name,a.user_tel,a.user_addr,a.message,a.create_time,a.create_date,b.good_id,b.good_name,b.amount,b.price,b.price_desc FROM `order` a LEFT JOIN order_detail b on a.id=b.order_id where a.category_id='{$cid}' and a.create_date='{$createDate}' and a.`status`='1'";
            $details = BaseData::sql ( $sql );
            if ($details) {
				if ($type == 1) {
					foreach ( $details as $detail ) {
						$tmp [$detail ['user_id']] [] = $detail;
						$totalPrices [$detail ['user_id']] += intval ( $detail ['price'] ) * intval ( $detail ['amount'] );
					}
					$details = $tmp;
					$tpl = "Manage/order_detail.html";
				} elseif ($type == 2) {
				    
					$tpl = "Manage/order_detail_.html";
				} else {
					exit ();
				}
			}
        }
        //print_r($details);
        $this->assign ( 'totalPrices', $totalPrices );
        $this->assign ( 'details', $details );
        $this->display ($tpl);
    }
    
    /**
     * 暂停营业
     */
    public function offAction() {
    
    }
    
    /**
     * 恢复营业
     */
    public function onAction() {
    
    }
}