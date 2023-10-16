
 <?php

require_once './app/model/productModel.php';
require_once './app/view/productView.php';
require_once './app/view/errorView.php';
//require_once './app/helpers/auth.helper.php';

class productController{

    private $modelProd;
    private $viewProd;
    private $errorView;
    //private $authHelper;

    public function __construct(){
        //$this->authHelper= new AuthHelper();
        $this->modelProd = new productModel();
        $this->viewProd = new productView();
        $this->errorView = new errorView();
    }

    public function showProducts(){     
        $products = $this->modelProd->getProducts();
        $this->viewProd->showProducts($products); //falta metodo?
    }

    public function showDetails($id){
        $product = $this->modelProd->getProduct($id);
        $this->viewProd->showDetails($product); //checkear, va de showdetails a showdetails
    }


    //mostrar productos para admin, tiene sentido??
    public function showProductsAdmin(){
        authHelper::init(); //que es el init??
        $products = $this->modelProd->getProducts();
        $this->viewProd->listProductsAdmin($products);
    }
    
    //cambiar parametros
    public function addProduct(){

        $name = $_POST['name'];  
        $category = $_POST['category'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        if(empty($name)||empty($category)||empty($price)){ //cambiar el quantity en la base de datos por null
            $this->errorView->showError("Complete todos los campos");
            return;
        }

        $id = $this->modelProd->insertProduct($name, $category, $price, $quantity);

        if($id){
            header('Location: ' . BASE_URL . 'listProductsAdmin');
        } else {
            $this->errorView->showError("Error al insertar el producto");//
        }        
    }

    public function removeProduct($id){
        $this->modelProd-> deleteProduct($id);
        header('Location: ' . BASE_URL . 'productsList');
    }

    public function showFormUpdateProduct($id){  
        authHelper::init();      
        $product = $this->modelProd->getProductsandMarcas($id);        
        $this->viewProd->showProductsandMarcas($product);
        require_once './templates/formUpdateProd.phtml';
        
    }
    
    //hacer form
    public function updateProduct($id){
        
        if(!empty($_POST['name'])&&!empty($_POST['category'])&&!empty($_POST['price'])){

            $name = $_POST['name'];
            $category = $_POST['category'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];

            $this->modelProd->updateProduct($id, $name, $category, $price, $quantity);
            header('Location: ' . BASE_URL . 'productsListAdmin');
        }            
    }
}
