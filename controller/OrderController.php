<?php
class OrderController extends BaseController {
    
    public function indexAction() {
        $this->display ();
    }
    
    /**
     * 购物车
     */
    public function cartAction() {
        if (ComTool::isAjax ()) {
        
        }
        //$cart = $_SESSION ['cart'];
        $this->display ();
    }
    
    /**
     * 加入购物车
     */
    public function acAction() {
        if (ComTool::isAjax ()) {
            //$cart = $_SESSION ['cart'];
            ComTool::ajax ( 100000, 'ok' );
        }
    }
    
    /**
     * update cart更新购物车
     */
    public function ucAction() {
        if (ComTool::isAjax ()) {
            //$cart = $_SESSION ['cart'];
            ComTool::ajax ( 100000, 'ok' );
        }
    }
    
    /**
     * 提交订单
     */
    public function goAction() {
        if (ComTool::isAjax ()) {
            $cart = $_SESSION ['cart'];
            if (! $cart) {
                ComTool::ajax ( 100001, '购物车为空' );
            }
        }
    }
    
    /**
     * 取消订单
     */
    public function cancelAction() {
    
    }
}