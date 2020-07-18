<?php 
    namespace utils;
    use Firebase\JWT\JWT;

    class Auth {

        public static $key = 'jsonwebtoken';
        
        public static function signIn($data) {
            $time = time();
            $payload = array(
                'iat' => $time,
                'exp' => $time + (60*60*24),
                "data" => $data
            );
            
            $token = JWT::encode($payload, self::$key);
            $_SESSION['token'] = $token;
            return $token;
        }
    }

?>