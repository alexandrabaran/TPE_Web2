<?php

//require_once 'config.php';

class productModel{
    protected $db;
     
    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=organia;charset=utf8', 'root', '');
    }

    public function getProducts(){

        $query = $this->db->prepare('SELECT products.*, categories.category_name as category_name FROM products JOIN categories ON categories.category_id = products.category_id');
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

//falta metodo productList??

    public function getProduct($id){

        $query = $this->db->prepare('SELECT products.*, categories.category_name as category_name FROM products JOIN categories ON categories.category_id = products.category_id  WHERE product_id = ?');
        $query->execute([$id]);
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }


    //formulario insertar producto
    public function addProduct($name, $category, $price, $quantity){
        $query = $this->db->prepare('INSERT INTO products (product_name, category_id, product_price, product_stock) VALUES (?,?,?,?)');
        $query->execute([$name, $category, $price, $quantity]);
    }
    //campo borrar producto?? admin tiene que ver los id

    public function deleteProduct($id){
        $query = $this->db->prepare('DELETE FROM products WHERE product_id = ?');
        $query->execute([$id]);
    }

    public function deleteProductFromCategory($category_id){
        $query = $this->db->prepare('DELETE FROM products WHERE category_id = ?');
        $query->execute([$category_id]);
    } 

    public function updateProduct($name, $quantity, $price, $category, $id){
        $query = $this->db->prepare('UPDATE products SET product_name = ? , product_stock = ? , product_price = ? , category_id = ? WHERE product_id = ?');
        $query->execute([$name, $quantity, $price, $category, $id]);
        
    }
}