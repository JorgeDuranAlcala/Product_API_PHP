<?php
    namespace controllers;

    include_once("database/User.php");

    use database\User as UserDB;

    class Users {

        private $userDB;

        public function __construct() {
            $this->userDB = new UserDB();
        }


        public function signup($req)
        {
            $body = $req->getBody();

            $user = $this->userDB->signUpUser($body['username'], $body['email'], $body['password']);

            return json_encode(array(
                'message' => "User Signed up successfuly", 
                $user
            ));
        }
        public function login($req)
        {
            return json_encode($req);
        }

    }


?>