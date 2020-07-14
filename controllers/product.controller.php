<?php
    namespace controllers;

    class Product
    {

        public function __construct() {
            
        }

        public  function createProduct($req)
        {
            return json_encode($req->getBody());
        }
        
        public  function getByIdProduct($req)
        {
            # code...
            return "Get product by id";
        }
        public  function getAllProducts($req)
        {
            return "Get all products";
        }
        public  function deleteProduct($req)
        {
            # code...
            return "delete product";
        }
        public  function updateProduct($req)
        {
            return json_encode($req->getBody());
            # code...
        }
    }
    

?>