<?php

class index extends controller {

    function __construct($module) {
        parent::__construct($module);
    }

    function index() {
        auth::handleLogin();
        $this->view->render('index/index', false, false, $this->module);
    }

}

?>