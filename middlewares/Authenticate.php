<?php 

    namespace middlewares;

    use \Firebase\JWT\JWT;

    class Authenticate
    {
        /* 
        * @param Request $req the request object of the current method
        * @param Closure $next a function which will be return in the end
        */
        public function invoke($req, $next) 
        {
            $headerArr = getallheaders();
            $token = $headerArr['Authorization'];
            $key = "jsonwebtoken";

            $data = JWT::decode($token, $key, ["HS256"]);

            $req->data = $data;

            return $next($req);

        }
    }


?>