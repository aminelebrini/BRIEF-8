<?php
    include_once __DIR__ . "/../data/connect_db.php";
    include_once __DIR__ . "/../data/user.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signin'])) {
    $signinv = new User($conn);
    $signinv->signin(
        $_POST['email'],
        $_POST['password']
    );
}