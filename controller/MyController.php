<?php
class MyController extends BaseController {
    
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
        $curPage = intval ( $this->param ( 'p', 1 ) );
        $pageSize = 10;
        $start = 1;
        $curUser = $this->getCurrentUser ();
        $where = "user_id='{$curUser['id']}' and status='1'";
        $sql = "select * from `order` where {$where} order by create_time desc limit {$start},{$pageSize}";
        $sql = "select * from `order` where create_time>=(select create_time from `order` order by create_time limit {$start},1) order by create_time desc limit {$pageSize}";
        $list = OrderData::sql ( $sql );
        $totalItems = 110;
        //$totalItems = OrderData::count ( $where );
        $pageTool = new Cola_Ext_Pager ( $curPage, $pageSize, $totalItems, $this->urlroot . 'my/order/p' );
        $pageTool->config ( 'prevNums', '3' );
        $pageTool->config ( 'nextNums', '3' );
        $pageTool->config ( 'prefix', '<div class="pagination"><ul>' );
        $pageTool->config ( 'first', '<li><a href="%link%/%page%">%page%...</a></li>' );
        $pageTool->config ( 'last', '<li><a href="%link%/%page%">...%page%</a></li>' );
        $pageTool->config ( 'prev', '<li><a href="%link%/%page%">上一页</a></li>' );
        $pageTool->config ( 'next', '<li><a href="%link%/%page%">下一页</a></li>' );
        $pageTool->config ( 'current', '<li><a href="javascript:void(0);"><strong>%page%</strong></a></li>' );
        $pageTool->config ( 'page', '<li><a href="%link%/%page%">%page%</a></li>' );
        $pageTool->config ( 'suffix', '</ul></div>' );
        $pageHtml = $pageTool->html ();
        $this->assign ( 'list', $list );
        $this->assign ( 'pageHtml', $pageHtml );
        $this->display ();
    }
    
    /**
     * 我的圈子
     */
    public function groupAction() {
    
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