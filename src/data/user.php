<?php
    include __DIR__ . "/connect_db.php";

    class User{
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

                   if($_SESSION['user_role'] === 'admin')
                   {
                    $_SESSION['user'] = $user;
                    header('Location: /pageAdmin');
                    exit;
                   }
                   if($_SESSION['user_role'] === 'reader')
                   {
                    $_SESSION['user'] = $user;
                    header('Location: /pageUser');
                    exit;
                   }
            }
            else{
                echo "connecxion non reaussi";
            }
        }
    }
?>