
<?php 

    include __DIR__ . "/../data/connect_db.php";
    include __DIR__ . "/../models/user.php";

class Auth {
    
    public static function login($conn,string $email, string $password): bool {
        $query = "SELECT * FROM users WHERE email = ?";
        $statement = $conn->prepare($query);
        $statement->execute([$email]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'firstname' => $user['firstname'],
                'lastname' => $user['lastname'],
                'email' => $user['email'],
                'role' => $user['role']
            ];
            return true;
        }

        return false;
    }

    public static function signup($conn , string $firstname, string $lastname, string $email, string $password): bool {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO users (firstname, lastname, email, password, role) VALUES (?, ?, ?, ?, ?)";
        $statement = $conn->prepare($query);
        return $statement->execute([$firstname, $lastname, $email, $hashedPassword, 'reader']);
    }

    
    public static function logout(): void {
        session_destroy();
        header("Location: /home");
        exit();
    }
}


if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['login']))
{
     $emaillogin = $_POST['email'] ?? '';
     $passwordlogin = $_POST['password'] ?? '';

     if(Auth::login($conn, $emaillogin, $passwordlogin))
     {
        header("Location: /home");
        exit();
     }
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup']))
{
    $firstnameup = $_POST['firstname'] ?? '';
    $lastnameup  = $_POST['lastname'] ?? '';
    $emailup     = $_POST['email'] ?? '';
    $passwordup  = $_POST['password'] ?? '';

    if(Auth::signup($conn, $firstnameup, $lastnameup, $emailup, $passwordup))
    {
        header("Location / formulaire");
        exit();
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout']))
{
    Auth::logout();
}
?>