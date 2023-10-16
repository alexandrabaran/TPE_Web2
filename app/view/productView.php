<?php

class productView{

    public function showProducts ($products, $category){
        require 'templates/productList.html';
    }

    public function showDetails($product, $category){
        require 'templates/productDetail.phtml';
    }    
}