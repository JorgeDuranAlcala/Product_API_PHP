<?php
    namespace controllers;

    class Product
    {

        public function __construct($type) {
            $this->type = $type;
        }

        static public function createProduct($req)
        {
            return json_encode($req->getBody());
        }

        static public function getByIdProduct()
        {
            # code...
        }
        static public function getAllProducts()
        {
            # code...
        }
        static public function deleteProduct()
        {
            # code...
        }
        static public function updateProduct()
        {
            # code...
        }
    }
    

?>