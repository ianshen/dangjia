<?php
class ShopController extends BaseController {
    
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
	
	public function editStoreAction() {
		$currUser = $this->refreshCurrentUser ();
		if (ComTool::isAjax ()) {
			if (isset ( $_POST ['captcha'] )) {
				$captcha = trim ( $this->post ( 'captcha' ) );
				if (! ComTool::checkCaptcha ( $captcha )) {
					ComTool::ajax ( 100001, '验证码错误' );
				}
			}
			$desc = trim ( $this->post ( 'desc' ) );
			ComTool::checkMaxLen ( $desc, 200, '店铺介绍最多200位' );
			$announce = trim ( $this->post ( 'announce' ) );
			ComTool::checkMaxLen ( $announce, 200, '店铺公告最多200位' );
			$sql = "UPDATE `store` SET `desc`='{$desc}',`announce`='{$announce}' WHERE id='{$currUser['id']}' limit 1";
			$res = BaseData::sql ( $sql );
			if ($res === false) {
				ComTool::ajax ( 100001, '服务器忙，请刷新重试' );
			}
			ComTool::ajax ( 100000, '保存成功' );
		}
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
            ComTool::checkMinMaxLen ( $curpass, 6, 16, '密码6-16字' );
            ComTool::checkEqual ( md5 ( $curpass ), $currUser ['passwd'], '当前登录密码错误，请检查' );
            $passwd = trim ( $this->post ( 'passwd' ) );
            ComTool::checkEmpty ( $passwd, '请输入新登录密码' );
            ComTool::checkMinMaxLen ( $passwd, 6, 16, '密码6-16字' );
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
                    foreach ( $details as $detail ) {
                        $tmp [$detail ['id']] [] = $detail;
                        $statistics [$detail ['good_id']] ['good_name'] = $detail ['good_name'];
                        $statistics [$detail ['good_id']] ['amount'] += intval ( $detail ['amount'] );
                    }
                    $details = $tmp;
                    $this->assign ( 'statistics', $statistics );
                    $tpl = "Manage/order_detail_.html";
                } else {
                    exit ();
                }
            }
        }
        $this->assign ( 'createDate', $createDate );
        $this->assign ( 'totalPrices', $totalPrices );
        $this->assign ( 'details', $details );
        $this->display ( $tpl );
    }
    
    /**
     * 暂停/开始营业
     */
    public function onoffAction() {
        $currUser = $this->getCurrentUser ();
        if (ComTool::isAjax ()) {
            $cid = intval ( $this->post ( 'cid', 0 ) );
            $op = $this->post ( 'op', 'on' );
            ComTool::checkEmpty ( $cid, '必选参数为空' );
            $time = time ();
            $status = 0;
            if ($op == 'on') {
                $status = 1;
            } elseif ($op == 'off') {
                $status = 3;
            } else {
                ComTool::ajax ( 100001, '参数错误，请刷新重试' );
            }
            $sql = "UPDATE `category` SET `status`='{$status}',update_time='{$time}' WHERE id='{$cid}' and store_id='{$currUser['id']}';";
            $res = BaseData::sql ( $sql );
            if ($res === false) {
                ComTool::ajax ( 100001, '服务器忙，请刷新重试' );
            }
            ComTool::ajax ( 100000, '操作成功' );
        }
    }
    
    /**
     * 分类管理
     */
    public function cateAction() {
        $currUser = $this->getCurrentUser ();
		$cates = ShopData::getStoreCates ( $currUser ['id'] );
		$this->assign ( 'cates', $cates );
		$this->display ();
    }
    
    /**
     * 添加商品分类
     */
    public function addCateAction() {
        $currUser = $this->getCurrentUser ();
        if (ComTool::isAjax ()) {
            if (isset ( $_POST ['captcha'] )) {
                $captcha = trim ( $this->post ( 'captcha' ) );
                if (! ComTool::checkCaptcha ( $captcha )) {
                    ComTool::ajax ( 100001, '验证码错误' );
                }
            }
            $name = trim ( $this->post ( 'name' ) );
            ComTool::checkMinMaxLen ( $name, 1, 16, '分类名1-16字' );
            $desc = $this->post ( 'desc' );
            ComTool::checkMaxLen ( $desc, 200, '分类描述最多200字' );
            $res = ShopData::addStoreCate ( array (
                'store_id' => $currUser ['id'], 
                'name' => $name, 
                'desc' => $desc, 
                'create_time' => time (), 
                'update_time' => time (), 
                'status' => 1 
            ) );
            if ($res === false) {
                ComTool::ajax ( 100001, '服务器忙，请刷新重试' );
            }
            ComTool::ajax ( 100000, '操作成功' );
        }
    }
    
    /**
     * 删除分类
     */
    public function delCateAction() {
        $currUser = $this->getCurrentUser ();
        if (ComTool::isAjax ()) {
            $cid = intval ( $this->post ( 'cid', 0 ) );
            $sql = "DELETE FROM `store_category` WHERE id='{$cid}' and store_id='{$currUser ['id']}';";
            $res = BaseData::sql ( $sql );
            if ($res === false) {
                ComTool::ajax ( 100001, '服务器忙，请刷新重试' );
            }
            ComTool::ajax ( 100000, '操作成功' );
        }
    }
    
    /**
     * 商品管理
     */
    public function goodsAction() {
        $currUser = $this->getCurrentUser ();
		$editId = intval ( $this->param ( 'edit', 0 ) );
		if ($editId) {
			$good = ShopData::getStoreGood ( $editId );
			$this->assign ( 'good', $good );
			$tpl = "Shop/edit_good.html";
		} else {
			$goods = ShopData::getStoreGoods ( $currUser ['id'] );
			$this->assign ( 'goods', $goods );
			$tpl = "Shop/goods.html";
		}
		$cates = ShopData::getStoreCates ( $currUser ['id'] );
		$this->assign ( 'cates', $cates );
		$this->display ( $tpl );
    }
    
    /**
     * 添加商品
     */
    public function addGoodAction() {
        $currUser = $this->getCurrentUser ();
        if (ComTool::isAjax ()) {
        	if (isset ( $_POST ['captcha'] )) {
        		$captcha = trim ( $this->post ( 'captcha' ) );
        		if (! ComTool::checkCaptcha ( $captcha )) {
        			ComTool::ajax ( 100001, '验证码错误' );
        		}
        	}
            $name = trim ( $this->post ( 'name' ) );
            ComTool::checkMinMaxLen ( $name, 1, 30, '商品名称1-30字' );
            $cate = intval ( $this->post ( 'cate', 0 ) );
            $price = trim ( $this->post ( 'price' ) );
            ComTool::checkMinMaxLen ( $price, 1, 30, '价格1-30字' );
            $desc = trim ( $this->post ( 'desc' ) );
            ComTool::checkMaxLen ( $desc, 100, '商品说明最多100字' );
            $res = ShopData::addStoreGood ( array (
                'store_id' => $currUser ['id'], 
                'name' => $name, 
                'desc' => $desc, 
                'store_cate_id' => $cate, 
                'price' => $price, 
                'create_time' => time (), 
                'update_time' => time (), 
                'status' => 1 
            ) );
            if ($res === false) {
                ComTool::ajax ( 100001, '服务器忙，请刷新重试' );
            }
            ComTool::ajax ( 100000, '操作成功' );
        }
    }
    
    /**
     * 编辑商品
     */
    public function editGoodAction() {
    	$currUser = $this->getCurrentUser ();
		if (ComTool::isAjax ()) {
			if (isset ( $_POST ['captcha'] )) {
				$captcha = trim ( $this->post ( 'captcha' ) );
				if (! ComTool::checkCaptcha ( $captcha )) {
					ComTool::ajax ( 100001, '验证码错误' );
				}
			}
			$id = intval ( $this->post ( 'gid' ) );
			$name = trim ( $this->post ( 'name' ) );
			ComTool::checkMinMaxLen ( $name, 1, 30, '商品名称1-30字' );
			$cate = intval ( $this->post ( 'cate', 0 ) );
			$price = trim ( $this->post ( 'price' ) );
			ComTool::checkMinMaxLen ( $price, 1, 30, '价格1-30字' );
			$desc = trim ( $this->post ( 'desc' ) );
			ComTool::checkMaxLen ( $desc, 100, '商品说明最多100字' );
			$data = array (
				'id' => $id, 
				'store_id' => $currUser['id'], 
				'name' => $name, 
				'desc' => $desc, 
				'store_cate_id' => $cate, 
				'price' => $price, 
				'update_time' => time (), 
			);
			$res = ShopData::editStoreGood ( $data );
			if ($res === false) {
				ComTool::ajax ( 100001, '服务器忙，请刷新重试' );
			}
			ComTool::ajax ( 100000, '操作成功', $this->urlroot . 'shop/goods' );
		}
    }
	
	/**
	 * 删除商品
	 */
	public function delGoodAction() {
		$currUser = $this->getCurrentUser ();
		if (ComTool::isAjax ()) {
			$gid = intval ( $this->post ( 'gid', 0 ) );
			$sql = "DELETE FROM `store_goods` WHERE id='{$gid}' and store_id='{$currUser ['id']}';";
			$res = BaseData::sql ( $sql );
			if ($res === false) {
				ComTool::ajax ( 100001, '服务器忙，请刷新重试' );
			}
			ComTool::ajax ( 100000, '操作成功' );
		}
	}
	
	/**
	 * 小店通
	 */
	public function infoAction() {
		$currUser = $this->getCurrentUser ();
		include "tool/phpqrcode/qrlib.php";
		$dir = 'static/u/s/' . md5 ( $currUser ['id'] ) . '/';
		if (! file_exists ( $dir )) {
			@mkdir ( $dir );
		}
		$filename = $dir . "qr_{$currUser['id']}.png";
		if (! file_exists ( $filename )) {
			$url = $this->urlroot . 'page/show/t/1/s/1';
			QRcode::png ( $url, $filename, 'H', 7, 2 );
		}
		$this->assign ( 'filename', $filename );
		$this->display ();
	}
	
	/**
	 * 定制名片
	 */
	public function orderCardAction(){
		$currUser = $this->getCurrentUser ();
        if (ComTool::isAjax ()) {
            $num = intval ( $this->post ( 'num', 0 ) );
            ComTool::checkEmpty ( $num, '请填写要定制的名片数量' );
            $name = trim ( $this->post ( 'name' ) );
            ComTool::checkMinMaxLen ( $name, 1, 16, '收件人姓名1-16字' );
            $mobile = trim ( $this->post ( 'mobile' ) );
            ComTool::checkEmpty ( $mobile, '请填写手机号' );
            $data=array('');
            $res = ShopData::orderCard ( $data );
        }
	}
    
    /**
     * 用户指南
     */
    public function helperAction() {
        $this->display ();
    }
}