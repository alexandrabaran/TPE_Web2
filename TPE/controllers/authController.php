<?php

require_once './models/adminModel.php';
require_once './views/authView.php';
require_once './views/category.view.php';
require_once './helpers/authHelper.php';

class authController{

    private $model;
    private $view;
    private $catView;

    public function __construct(){
        $this->model = new adminModel();
        $this->view = new authView();
        $this->catView = new CategoryView();
    }

    public function showLoginForm(){
            $this->view->showLogin();
    }

    public function showPanel(){
        $this->view->showAdminPanel();
    }

    public function login(){

        $user = $_POST['user'];
        $password = $_POST['password'];

        if(empty($user)||empty($password)){
            $this->catView->showError('Completar todos los campos');
            return;
        }

        $userFromDB = $this->model->getAdminByUser($user);
        
        if($userFromDB && password_verify($password, $userFromDB->user_password)){
            authHelper::login($userFromDB);
            header('Location: ' . BASE_URL . 'panel');
        } else {
            $this->catView->showError('Usuario inválido');
        }
    }

    public function logout() {
        authHelper::logout();
        header('Location: ' . BASE_URL);    
    }

}