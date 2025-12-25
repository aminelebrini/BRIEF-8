<?php
class Router {
    private $pages;

    public function __construct($pages) {
        $this->pages = $pages;
    }

    public function route(): void {
        $page = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if ($page === '/' || $page === '') {
            $page = '/home';
        }

        if (in_array($page, $this->pages)) {
            $view = __DIR__ . "/../views$page.php";
        } else {
            $view = __DIR__ . "/../views/404.php";
        }

        require_once $view;
        
    }
}
?>
