<?php

    include __DIR__ . "/user.php";

    class Reader extends User{

        public function __construct($id,$firstname = "", $lastname = "", $email = "", $password = "", $role)
        {
            return parent::__construct($id,$firstname, $lastname, $email, $password, $role = "reader");
        }
    }
?>