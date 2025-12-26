<?php

session_start();

include __DIR__ . "/../public/router.php";

$Routes = ['/', '/home', '/service', '/contact','/formulaire', '/profile', '/dashboard'];

$Route = new Router($Routes);
$Route->route();
