<?php
    namespace database;

    include_once('db.php');
    include_once("models/User.php");
    require("vendor/autoload.php");
    
    use \Firebase\JWT\JWT;
    use database\Database as DB;
    use models\User as IUser;

    class User extends DB implements IUser
    {

        protected $table = 'users';

        public function __construct() {
            $this->conn = mysqli_connect($this->host_name, $this->username_db, $this->pass_db, $this->db_name);
        }

        public function signUpUser(string $username, string $email, string $password)
        {

            $key = "jsonwebtoken";
            $time = time();

            $payload = array(
                'iat' => $time,
                'exp' => $time + (60*60*24),
                'data' => $user  
            );

            $token = JWT::encode($payload, $key);

            $query = "INSERT INTO $this->table(username, email, password, token) VALUES('$username', '$email', '$password', '$token')";
            $result = mysqli_query($this->conn, $query);
            
            if($result) {
                
                return $result;

            } else {
                throw new Exception("Error Processing Request" . mysqli_error($this->conn), 1);
            }
        }
        public function loginUser(string $email, string $password)
        {

        }

        
    }
    

?>