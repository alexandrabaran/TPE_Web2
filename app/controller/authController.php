<?php

require_once './app/model/adminModel.php';
require_once './app/view/authView.php';
require_once './app/helpers/authHelper.php';

class authController{

    private $model;
    private $view;

    public function __construct(){
        $this->model = new adminModel();
        $this->view = new authView();
    }

    public function showLoguin(){
        $this->view->showLoguin();
    }

    public function auth(){

        $user = $_POST['user']; //que form es?
        $password = $_POST['password'];

        
        if(empty($user)||empty($password)){
            $this->view->showLoguin('Completar todos los campos');
            
            return;
        }

        $user = $this->model->getAdminByUser($user);
        
        if($user && password_verify($password, $user->password)){
            
           authHelper::loguin($user);
            header('Location: ' . BASE_URL . 'panelAdmin');
        } else {
            $this->view->showLoguin('Usuario inválido');
        }
    }

 //funcion logout

}