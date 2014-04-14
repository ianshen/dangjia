<?php
class GroupController extends BaseController {
	
	public function indexAction() {
		//http://localhost/dangjia/index.php/g/1
		$gid = $this->param ( 'gid' );
		$group = GroupData::getById ( $gid );
		if (! $group) {
			$url = ComTool::url ( "index" );
			header ( "Location:{$url}" );
		}
		//根据群组id获取群组支持的分类，一级和二级
		$cats = CategoryData::groupCategorys ( $gid );
		$this->assign ( 'cats', $cats );
		$this->assign ( 'group', $group );
		$this->display ();
	}
}