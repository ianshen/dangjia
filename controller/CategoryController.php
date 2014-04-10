<?php
class CategoryController extends BaseController {
    
    public function indexAction() {
        $cid = $this->param ( 'cid' );
        $cid = 1;
        $goods = GoodsData::getsByCid ( $cid );
        $this->display ();
    }
}