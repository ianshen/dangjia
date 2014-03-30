<?php
class IndexController extends BaseController {
	
	public function indexAction() {
		//判断是否登录，若已登录，跳转至我的首页
		if ($this->isLogin ()) {
			$jumpUrl = '';
			header ( "Location:{$jumpUrl}" );
		}
		//获取所有城市
		$citys = RegionData::getsByPid ();
		$this->assign ( 'citys', $citys );
		$this->display ();
	
		//获取所有圈子
	/* $groups = GroupData::getsAll ();
		$this->assign ( 'groups', $groups );
		//获取所有地区
		$regions = RegionData::getsAll ();
		foreach ( $regions as $k => $region ) {
			if ($region ['pid'] == 0) {
				$region ['regions'] = array ();
				$parents [$region ['id']] = $region;
				unset ( $regions [$k] );
			}
		}
		foreach ( $regions as $k => $region ) {
			$parents [$region ['pid']] ['regions'] [] = $region;
		}
		$regions = $parents;
		print_r ( $regions ); */
	
	}
}