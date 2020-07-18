<?php
    namespace controllers;

    include_once("database/Product.php");

    use utils as util;
    use database as db;

    class Product
    {

        private $productDB;

        public function __construct() {
            
            $this->productDB = new db\Product();

        }

        public  function createProduct($req)
        {

            $body = $req->getBody();

            
            $data = [];
            
            foreach ($body as $key => $value) {
                # code...
                array_push($data, $value);
            }
            
            list($name, $category, $price) = $data;
            $result = $this->productDB->createProduct($name, $category, $price);

            return json_encode($result);
        }
        
        public  function getByIdProduct($req)
        {
            # code...
            $param = $req->queryString;
            $arr = preg_split("/\=/", $param);
            $id = $arr[1];

            $product = $this->productDB->getProductById($id);

            return json_encode(array(
                "message"=>"Succesfuly Request", 
                "product" => $product, 
                "token" => $req->data
            ));
        }
        public function getAllProducts($req)
        {

            $products = $this->productDB->getAllProducts();

            return json_encode(array("message"=>"Get all Products", "products" => $products));
        }
        public function deleteProduct($req)
        {
            $param = $req->queryString;
            $arr = preg_split("/\=/", $param);
            $id = $arr[1];

            $result = $this->productDB->deleteProduct($id);
            
            return json_encode($result);
        }
        public  function updateProduct($req)
        {
            $body = $req->getBody();

            
            $data = [];
            
            foreach ($body as $key => $value) {
                # code...
                array_push($data, $value);
            }
            
            list($name, $category, $price) = $data;
            $param = $req->queryString;
            $arr = preg_split("/\=/", $param);
            $id = $arr[1];

            $result = $this->productDB->updateProduct($id, $name, $category, $price);

            return json_encode($result);
            # code...
        }
    }
    

?>