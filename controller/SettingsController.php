<?php
/**
 * 设置
 * @author Ian
 *
 */
class SettingsController extends BaseController {
    
    protected $mustLogin = 1;
    
    public function __construct() {
        parent::__construct ();
        $this->mustLoginCheck ();
    }
    
    public function indexAction() {
    
    }
}