<?php

    namespace models;

    interface User {
        public function signUpUser(string $username, string $email, string $password);
        public function loginUser(string $email, string $password);
    }

?>