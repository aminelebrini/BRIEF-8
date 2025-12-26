<?php
    include __DIR__ . "/user.php";

    class Admin extends User{

        public function __construct($firstname="", $lastname="", $email="", $password="", $role="")
        {
            return parent::__construct($firstname, $lastname, $email, $password, "admin");
        }
    }
?>