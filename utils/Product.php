<?php
    namespace utils;

    include_once("models/Product.php");

    use models as md;

    class Product implements md\Product
    {
        public $name;
        public $category;
        public $price;

        public function __construct($name, $category, $price) {
            $this->name = $name;
            $this->category = $category;
            $this->price = $price;
        }

        public static function createProduct($name, $category, $price): Product {
            return new Product($name, $category, $price);
        }
    }
    


?>