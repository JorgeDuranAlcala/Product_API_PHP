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

            
            $query = "INSERT INTO $this->table(username, email, password) VALUES('$username', '$email', '$password')";
            $result = mysqli_query($this->conn, $query);
            
            if($result) {
                $payload = array(
                    'iat' => $time,
                    'exp' => $time + (60*60*24),
                );
                
                $token = JWT::encode($payload, $key);
                $_SESSION['token'] = $token;
                
                return $result;

            } else {
                print_r("Error Processing Request" . mysqli_error($this->conn), 1);
            }
        }
        public function loginUser(string $email, string $password)
        {
            $query = "SELECT * FROM $this->table WHERE email='$email' AND password='$password'";
            $result = mysqli_query($this->conn, $query);
            if($result) {
                return $result->fetch_assoc();
            } else {
                print_r("Error Processing Request" . mysqli_error($this->conn), 1);
            }
        }

        
    }
    

?>