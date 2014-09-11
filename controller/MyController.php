<?php
class MyController extends BaseController {
    
    protected $mustLogin = 1;
    
    public function __construct() {
        parent::__construct ();
        $this->mustLoginCheck ();
    }
    
    /**
     * 我的首页
     */
    public function indexAction() {
        //获取我的圈子(我的群组)===是否存入SESSION?
        $uid = $_SESSION ['uid'];
        $myGroups = UserGroupData::getsGroupByUID ( $uid );
        $this->assign ( 'groups', $myGroups );
        $this->display ();
    }
    
    /**
     * 我的订单
     */
    public function orderAction() {
        $pageSize = 20;
        $curPage = intval ( $this->param ( 'p', 1 ) );
        $curPage = $curPage < 1 ? 1 : $curPage;
        $curUser = $this->getCurrentUser ();
        $where = "user_id='{$curUser['id']}' and status='1'";
        $totalItems = OrderData::count ( $where );
        $list = array ();
        if ($totalItems) {
            $totalPages = ceil ( $totalItems / $pageSize );
            $curPage = $curPage > $totalPages ? $totalPages : $curPage;
            $start = $pageSize * ($curPage - 1);
            $sql = "select * from `order` where {$where} order by create_time desc limit {$start},{$pageSize}";
            $list = OrderData::sql ( $sql );
            if ($list) {
                $pageHtml = ComTool::pageHtml ( $curPage, $pageSize, $totalItems, $this->urlroot . 'my/order/p' );
            }
        }
        $this->assign ( 'list', $list );
        $this->assign ( 'pageHtml', $pageHtml );
        $this->display ();
    }
    
    /**
     * 我的圈子
     */
    public function groupAction() {
        $this->display ();
    }
    
    /**
     * 我的财富
     */
    public function propertyAction() {
    
    }
    
    /**
     * 我的积分（积分以penny形式表示，penny=角）
     */
    public function pennyAction() {
    
    }
    
    /**
     * 我的信息
     */
    public function infoAction() {
    
    }
    
    /**
     * 更改密码
     */
    public function passAction() {
    
    }
    
    /**
     * 我的地址
     */
    public function addrAction() {
    
    }

}