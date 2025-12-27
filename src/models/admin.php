<?php
    include __DIR__ . "/user.php";

    class Admin extends User{

        public function __construct($id, $firstname="", $lastname="", $email="", $password="", $role="")
        {
            return parent::__construct($id, $firstname, $lastname, $email, $password, "admin");
        }
    }
?>