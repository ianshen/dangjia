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
        $this->display ();
    }
}