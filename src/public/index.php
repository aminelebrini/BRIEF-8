<?php
include __DIR__ . "/../data/connect_db.php";
include __DIR__ . "/../public/router.php";

$Routes = ['/', '/home', '/service', '/contact','/formulaire', '/pageAdmin', '/pageUser'];

$Route = new Router($Routes);
$Route->route();
