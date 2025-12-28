<?php

session_start();

include __DIR__ . "/../public/router.php";

$Routes = ['/', '/home', '/service', '/contact','/formulaire', '/profile', '/dashboard', '/books', '/reserved','/reserveadmin', '/allusers'];

$Route = new Router($Routes);
$Route->route();
