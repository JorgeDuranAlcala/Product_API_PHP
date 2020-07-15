<?php 
    namespace database;

    include('database/db.php');

    use database as db;
    

    class Product extends db\Database
    {

        protected $table = "products";

        public function __construct() {
            $this->conn = mysqli_connect($this->host_name, $this->username_db, $this->pass_db, $this->db_name);
        }
        
        public function getProductById($id)
        {
            $query = "SELECT * FROM $this->table WHERE id=$id";
            $result = mysqli_query($this->conn, $query);

            if(isset($result)) {
                $product = $result->fetch_assoc();
                return $product;
            } else {
                return  array('error' => mysqli_error($this->conn));
            }
            
        }
        public function createProduct($name, $category, $price)
        {
            # code...
            $query = "INSERT INTO $this->table(name, category, price) VALUES('$name', '$category', '$price')";
            $result = mysqli_query($this->conn, $query);
            
            if(isset($result)) {
                return array('message' => "Created Sussesfully");
            } else {
                return array('error' => mysqli_error($this->conn));
            }
        }
        public function getAllProducts()
        {
            $query = "SELECT * FROM $this->table";
            $result = mysqli_query($this->conn, $query);
            $products = [];
            while ($row = $result->fetch_assoc()) {
                # code...
                array_push($products, $row);
            }

            return $products;
        }
        public function updateProduct($id, $name, $category, $price)
        {
            $query = "UPDATE $this->table SET name='$name', category='$category', price='$price'  WHERE id=$id";

            if($result = mysqli_query($this->conn, $query)) {
               return array('message' => 'updated Successfuly');
            } else {
                return "something went wrong" . mysqli_error($this->conn);
            }
            
        }
        public function deleteProduct($id)
        {
            $query = "DELETE FROM $this->table WHERE id=$id";
            $result = mysqli_query($this->conn, $query);

            if(isset($result)) {
                return array("mesage" => "deleted succesfuly");
            } else {
                return  array('error' => mysqli_error($this->conn));
            }
        }
    }
    

?>