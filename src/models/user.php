<?php
    include __DIR__ . "/../data/connect_db.php";


    class User
    {
        public int $id;
        public string $firstname;
        public string $lastname;
        public string $email;
        public string $password;
        public string $role = "reader";

    public function __construct($id , $firstname = "", $lastname = "", $email = "", $password = "", $role = "reader")
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname  = $lastname;
        $this->email     = $email;
        $this->password  = $password;
        $this->role      = $role;
    }

    public function get_id()
    {
        return $this->id;
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