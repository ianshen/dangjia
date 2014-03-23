<?php
class IndexController extends BaseController {
	
	public function indexAction() {
		//$r = UserData::getById ( 3 );
		/* $r = UserData::add ( array (
            'name' => 'ian', 
            'passwd' => md5 ( 'ian' ) 
        ) ); */
		//$r = UserData::del ( 1 );
		/* $r = UserData::modify ( 1, array (
            'name' => 'aaa', 
            'passwd' => md5 ( 'aaa' ) 
        ) ); */
		//var_dump ( $r );
		

		//判断是否登录，若已登录，跳转至我的首页
		if ($this->isLogin ()) {
			$jumpUrl = '';
			header ( "Location:{$jumpUrl}" );
		}
		//获取所有圈子
		$groups = GroupData::getsAll ();
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
		//print_r ( $regions );
		$this->display ();
	}
}