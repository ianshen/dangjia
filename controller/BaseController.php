<?php
class BaseController extends Cola_Controller {
	
	public $tplExt = '.html';
	
	protected $token = '';
	
	public function __construct() {
		$this->token = ComTool::buildToken ();
		$this->assign ( 'token', $this->token );
	}
	
	protected function assign($name, $value = '') {
		$this->view->$name = $value;
	}
	
	/**
	 * 判断是否登录
	 * @return boolean
	 */
	protected function isLogin() {
		return false;
	}
}