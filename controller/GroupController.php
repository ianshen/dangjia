<?php
class GroupController extends BaseController {
	
	public function indexAction() {
		//http://localhost/dangjia/index.php/g/1
		$gid = $this->param ( 'gid' );
		$gid = 1;
		//根据群组id获取群组支持的分类，一级和二级
		$cats = CategoryData::groupCategorys ( $gid );
		//print_r ( $cats );
		$this->display ();
	}
}