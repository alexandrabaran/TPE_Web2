<?php

require_once "./views/home.view.php";

class HomeController{

    private $view;

    public function __construct(){
        $this->view = new HomeView();
    }

    public function showHome(){
        $this->view->renderHome();
    }
}