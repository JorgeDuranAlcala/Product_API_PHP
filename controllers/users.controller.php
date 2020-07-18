<?php
    namespace controllers;

    include_once("database/User.php");
    include_once("utils/auth.php");

    use database\User as UserDB;
    use utils\Auth;

    class Users {

        private $userDB;

        public function __construct() {
            $this->userDB = new UserDB();
        }


        public function signup($req)
        {
            $body = $req->getBody();

            $user = $this->userDB->signUpUser($body['username'], $body['email'], $body['password']);
            if($user) {

                return json_encode(array(
                    'message' => "User Signed up successfuly", 
                    'token' => $_SESSION['token']
                ));
            } else {
                return json_encode(array(
                    'message' => "Something went wrong", 
                ));
            }
        }
        public function login($req)
        {
            $body = $req->getBody();
            $user = $this->userDB->loginUser($body['email'], $body['password']);
            $token = Auth::signIn($user);
            if($user) {
                return json_encode(array(
                    "message" => "Login user Successfuly",
                    "token" => $token
                ));
            } else {
                return json_encode(array(
                    "message" => "You're not signup yet"
                ));
            }
        }

    }


?>