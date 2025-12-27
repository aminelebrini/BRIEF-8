<?php
    include __DIR__ . "/../data/connect_db.php";


    class User
    {
        public string $firstname;
        public string $lastname;
        public string $email;
        public string $password;
        public string $role = "reader";

    public function __construct($firstname = "", $lastname = "", $email = "", $password = "", $role = "reader")
    {
        $this->firstname = $firstname;
        $this->lastname  = $lastname;
        $this->email     = $email;
        $this->password  = $password;
        $this->role      = $role;
    }

    public function get_firstname(){
        return $this->firstname;
    }
    public function get_lastname(){
        return $this->lastname;
    }
    public function get_email(){
        return $this->email;
    }
    public function get_password(){
        return $this->password;
    } 
    public function get_role(){
        return $this->role;
    }   
}


?>