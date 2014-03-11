<?php
class BaseController extends Cola_Controller {
    public $tplExt = '.html';
    
    protected function assign($name, $value = '') {
        $this->view->$name = $value;
    }
}