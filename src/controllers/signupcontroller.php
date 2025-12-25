<?php
    include_once __DIR__ . "/../data/connect_db.php";
    include_once __DIR__ . "/../data/user.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    $signupv = new User($conn);
    $signupv->signup(
        $_POST['firstname'],
        $_POST['lastname'],
        $_POST['email'],
        $_POST['password']
    );
}

?>