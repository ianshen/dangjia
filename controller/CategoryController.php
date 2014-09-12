<?php
class CategoryController extends BaseController {
    
    public function indexAction() {
        $cid = intval ( $this->param ( 'cid', 0 ) );
        if (! $cid) {
            $url = ComTool::url ( "index" );
            header ( "Location:{$url}" );
        }
        $category = CategoryData::getById ( $cid );
        if (! $category) {
            $url = ComTool::url ( "index" );
            header ( "Location:{$url}" );
        }
        $curTime = time ();
        $category ['start_time'] = '09:00:00';
        $category ['end_time'] = '24:00:00';
        $startTime = strtotime ( $category ['start_time'] );
        $endTime = strtotime ( $category ['end_time'] );
        $notStart = $curTime < $startTime ? true : false; //true为尚未开始
        $isOver = $curTime > $endTime ? true : false; //true为已结束
        $isOn = ! $notStart && ! $isOver; //过程中
        $this->assign ( 'notStart', $notStart );
        $this->assign ( 'isOver', $isOver );
        $this->assign ( 'isOn', $isOn );
        $group = GroupData::getById ( $category ['group_id'] );
        $store = StoreData::getById ( $category ['store_id'] );
        $goods = GoodsData::getsByCid ( $cid );
        $cart = array ();
        $cart = $this->getCart ( $cid );
        $this->assign ( 'category', $category );
        $this->assign ( 'group', $group );
        $this->assign ( 'store', $store );
        $this->assign ( 'goods', $goods );
        $this->assign ( 'products', $cart ['products'] );
        $this->assign ( 'totalPrice', $cart ['totalPrice'] );
        $this->display ();
    }
}