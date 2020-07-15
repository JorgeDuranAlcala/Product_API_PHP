<?php
    namespace database;

    include('database/db.php');

    use database as db;

    class Users extends db\Database
    {

        public function __construct() {
            $this->conn = mysqli_connect($this->host_name, $this->username_db, $this->pass_db, $this->db_name);
        }

        
    }
    

?>