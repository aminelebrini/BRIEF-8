<?php

session_start();

include __DIR__ . "/../public/router.php";

$publicRoutes = [ '/', '/home', '/service', '/contact', '/formulaire','/allbooks'];

$currentRoute = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$Routes = ['/', '/home', '/service', '/contact','/formulaire', '/profile', '/dashboard', '/books', '/reserved','/reserveadmin', '/allusers', '/allbooks'];

if (!isset($_SESSION['user']) && !in_array($currentRoute, $publicRoutes)) {
    header('Location: /home'); 
    exit;
}

$Route = new Router($Routes);
$Route->route();
