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

    public function get_firstname():string{
        return $this->firstname;
    }
    public function get_lastname():string{
        return $this->lastname;
    }
    public function get_email():string{
        return $this->email;
    }
    public function get_password():string{
        return $this->password;
    } 
    public function get_role(): string {
        return $this->role;
    }   
}





    /*class User{
        private $firstname;
        private $lastname;
        private $email;
        private $password;
        private $role = "reader";

        private $conn;


        public function __construct($conndb)
        {
            $this->conn = $conndb;
        }

        public function signup($firstname,$lastname,$email,$password)
        {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);            
            $statement = $this->conn->prepare("INSERT INTO users (firstname, lastname, email, password, role) VALUES(?,?,?,?,?)");
    
            if($statement->execute([$firstname, $lastname, $email, $hashedPassword, $this->role])) {
                echo "passed";
            } else {
                echo "not passed";
             }
        }

        public function signin($email, $password)
        {
            $query = "SELECT * FROM users WHERE email = ?";
            $statement = $this->conn->prepare($query);
            $statement->execute([$email]);            
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if(password_verify($password, $user['password']))
            {
                   $this->firstname = $user['firstname']; 
                   $this->lastname = $user['lastname']; 
                   $this->email = $user['email']; 
                   $this->role = $user['role'];

                   $_SESSION['user_id'] = $user['id'];
                   $_SESSION['user_role'] = $user['role'];

                   if($_SESSION['user_role'] === 'admin' || $_SESSION['user_role'] === 'reader')
                   {
                    $_SESSION['user'] = $user;
                    header("Location: /home");
                    exit;
                   }
            }
            else{
                echo "connecxion non reaussi";
            }
        }

        public function logout()
        {
            session_destroy();    
            header("Location: /home");
            exit;
        }
    }*/
?>