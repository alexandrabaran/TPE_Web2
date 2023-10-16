<?php

require_once './app/controller/productController.php';
require_once './app/controller/authController.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

//TABLA DE RUTEO

//productsList -->           productController--> showProducts();
//details/:ID->             productController--> showDetails(id);
//productsListAdmin -->      panelAdminController --> showPanelAdmin();
//addProduct -->           productController--> addProduct();
//removeProduct/:ID -->      productController--> removeProduct(id);
//updateProduct/:ID -->     productController--> updateProduct(id);
//loguin -->                 authController--> showLoguin();
//auth -->                  authController--> auth();

$action = 'productList';

if(!empty($_GET['action'])){
    $action = $_GET['action'];
}

$params = explode('/', $action); //como funciona explode y params

switch ($params[0]) {
    case 'productsList':
        $controller = new productController();
        $controller->showProducts();
        break;
    case 'details':
        $controller = new productController();
        $controller->showDetails($params[1]);
        break;
    case 'productsListAdmin': //crear esto, modificar arriba
        $controller = new panelAdminController();
        $controller->showPanelAdmin(); //que tiene que llamar a plantilla panelAdmin con 2 botones, Administrar productos (lleva a showProducts) y administrar categorias (lleva a showCategories)
        break;
    case 'addProduct':
        $controller = new productController();
        $controller->addProduct();
        break;
    case 'removeProduct':
        $controller = new productController();
        $controller->removeProduct($params[1]);
        break;
    case 'updateProduct':
        $controller = new productController();
        $controller->updateProduct($params[1]);
        break;
    case 'loguin':
        $controller = new authController();
        $controller->showLoguin(); 
        break;
    case 'auth':
        $controller = new authController();
        $controller->auth();
        break;
    default: 
        echo "ERROR - página no encontrada";
        break;
}