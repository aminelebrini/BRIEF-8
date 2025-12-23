<?php
    $page = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $pages = ['/', '/home', '/login'];

    if($page === '' || $page === '/')
    {
        $page = '/home';
    }
    if(in_array($page, $pages))
    {
        $view = __DIR__ . "/../views$page.php";
        require_once $view;
    }
    else{
        $view = __DIR__ . "/../views/404.php";
        require_once $view;
    }
    require_once $view;
?>