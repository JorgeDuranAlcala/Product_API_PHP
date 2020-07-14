<?php
    namespace controllers;

    class Product
    {

        public function __construct($type) {
            $this->type = $type;
        }

        public function sayHello()
        {
            return "QLQ man";
        }
    }
    

?>