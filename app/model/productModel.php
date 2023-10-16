<?php

require_once 'config.php';

class productModel{
    protected $db;
     
    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=organiadb;charset=utf8', 'root', '');
    }

    public function getProducts(){

        $query = $this->db->prepare('SELECT * FROM products');
        $query->execute();

        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

//falta metodo productList??

    public function getProduct($id){

        $query = $this->db->prepare('SELECT * FROM products WHERE id = ?');
        $query->execute([$id]);

        $product = $query->fetch(PDO::FETCH_OBJ);

        return $product;
    }


    //formulario insertar producto
    public function addProduct($name, $category, $quantity, $price){
        $query = $this->db->prepare('INSERT INTO products (product_name, product_category, product_quantity, product_price) VALUES (?,?,?,?)');
        $query->execute([$name, $category, $quantity, $price,]);

        return $this->db->lastInsertId(); //que es last insert id?? autoincremental id??
    }

     //verificar si el producto está antes de agregar y que los campos no estan vacios


    //campo borrar producto?? admin tiene que ver los id

    public function deleteProduct($id){
        $query = $this->db->prepare('DELETE FROM products WHERE id = ?');
        $query->execute([$id]);
    } //verificar si existe el id, sino error

    public function updateProduct($id, $name, $category, $quantity, $price){
        $query = $this->db->prepare('UPDATE products SET product_name = ? , product_category = ? , product_quantity = ? , product_price = ? , WHERE id = ?');
        $query->execute([$name, $category, $quantity, $price, $id]);
        
    }
}