<?php
    namespace models;

    require("database/Product.php");

    use database as db; 

    interface Product {
        public static function getProductById($id) ;
        public static function createProduct($name, $category, $price);
        public static function getAllProducts();
        public static function updateProduct($id, $name, $category, $price);
        public static function deleteProduct($id);
    }
    

?>