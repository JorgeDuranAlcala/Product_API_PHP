<?php
    namespace database;

    class Database
    {

        public $conn;
        public $host_name = "localhost";
        public $username_db = "root";
        public $pass_db = "kE3m3xQrwTXdmjsv";
        public $db_name = "products";

        public function __construct() {
            $this->conn = mysqli_connect($this->host_name, $this->username_db, $this->pass_db, $this->db_name);
        }

        
    }
    

?>