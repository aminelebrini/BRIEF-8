<?php
include_once __DIR__ . "/../data/connect_db.php";
include_once __DIR__ . "/../models/user.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signin'])) {

    $emaillogin = $_POST['email'] ?? '';
    $passwordlogin = $_POST['password'] ?? '';

    echo $emaillogin;
    echo $passwordlogin;

    $query = "SELECT * FROM users WHERE email = ?";
    $statement = $conn->prepare($query);
    $statement->execute([$emaillogin]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($passwordlogin, $user['password'])) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'firstname' => $user['firstname'],
            'lastname' => $user['lastname'],
            'email' => $user['email'],
            'role' => $user['role']
        ];

        header("Location: /home");
        exit();
    } else {
        echo "Email ou mot de passe incorrect";
    }
}
