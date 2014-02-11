<?php
class StoreController extends BaseController {
    
    public function indexAction() {
        $sid = $this->param ( 'sid' );
        //根据storeid取店铺商品分类
        $goodsType = GoodsTypeData::getsBySid ( $sid );
        //根据storeid取店铺商品清单
        $goods = GoodsData::getsBySid ( $sid );
        $this->display ();
    }
}