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

        if($user['role'] === 'admin')
        {
            $_SESSION['user'] = $user;
        }
        return true;
    }
    return false;
}

    public static function signup($conn , string $firstname, string $lastname, string $email, string $password): bool {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO users (firstname, lastname, email, password, role)
                  VALUES (?, ?, ?, ?, ?)";
        $statement = $conn->prepare($query);
        return $statement->execute([$firstname, $lastname, $email, $hashedPassword, 'reader']);
    }

    public static function logout(): void {
        session_destroy();
        header("Location: /home");
        exit();
    }
}


if($_SERVER['REQUEST_METHOD'] === "POST")
{
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if(Auth::login($conn, $email, $password)) {
        header("Location: /home");
        exit();
    }
}


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup']))
{
    $firstname = $_POST['firstname'] ?? '';
    $lastname  = $_POST['lastname'] ?? '';
    $email     = $_POST['email'] ?? '';
    $password  = $_POST['password'] ?? '';

    if(Auth::signup($conn, $firstname, $lastname, $email, $password))
    {
        header("Location: /formulaire");
        exit();
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout']))
{
    Auth::logout();
}
