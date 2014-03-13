<?php
class BaseController extends Cola_Controller {
    
    public $tplExt = '.html';
    
    public function __construct() {
        $token = ComTool::buildToken ();
        $this->assign ( 'token', $token );
    }
    
    protected function assign($name, $value = '') {
        $this->view->$name = $value;
    }
}