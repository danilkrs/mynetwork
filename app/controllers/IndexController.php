<?php

class IndexController{

    private $_dwoo;

    function __construct($dwoo){
        $this->_dwoo = $dwoo;
    }
    public function indexAction() {
        if(!isset($_SESSION['user'])) {
            header('Location: index.php?controller=user&action=signIn');
        } else {
            $data = array();
            $this->_dwoo->output('app/views/index/index.tpl', $data);
        }
    }
}
