<?php
include_once __DIR__ . "/../data/connect_db.php";
include_once __DIR__ . "/../models/user.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {

    $firstnameup = $_POST['firstname'] ?? '';
    $lastnameup  = $_POST['lastname'] ?? '';
    $emailup     = $_POST['email'] ?? '';
    $passwordup  = $_POST['password'] ?? '';

    $queryCheck = "SELECT * FROM users WHERE email = ?";
    $stmtCheck = $conn->prepare($queryCheck);
    $stmtCheck->execute([$emailup]);
    if ($stmtCheck->fetch(PDO::FETCH_ASSOC)) {
        echo "Cet email est déjà utilisé.";
        exit();
    }

    $hashedPassword = password_hash($passwordup, PASSWORD_BCRYPT);

    $query = "INSERT INTO users (firstname, lastname, email, password, role) VALUES (?, ?, ?, ?, ?)";
    $statement = $conn->prepare($query);

    if ($statement->execute([$firstnameup, $lastnameup, $emailup, $hashedPassword, 'reader'])) {
        $_SESSION['user'] = [
            'firstname' => $firstnameup,
            'lastname' => $lastnameup,
            'email' => $emailup,
            'role' => 'reader'
        ];

        header("Location: /home");
        exit();
    } else {
        echo "Erreur lors de l'inscription.";
    }
}
?>
