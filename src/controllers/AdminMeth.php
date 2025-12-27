<?php

    class AdminMeth{

        private $conn;

        public function __construct($conn)
        {
            $this->conn = $conn;
        }

        public function addBook(string $title, string $author, string $year, string $status = "available") {
            $query  = "INSERT INTO books (title, author, publication_year, status) VALUES (?, ?, ?, ?)";
            $statement = $this->conn->prepare($query);
            $statement->execute([$title, $author, $year, $status]);
        }

        public function removebook(string $title, string $author, string $year, string $status)
        {
            $query = "DELETE FROM books WHERE title = ?";
            $statement = $this->conn->prepare($query);
            $statement->execute([$title]);
        }
    }

    $adminaddbook = new AdminMeth($conn);

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addbook']))
    {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $year = $_POST['publication_year'];

        if(!empty($title) && !empty($author) && !empty($year))
        {
            $adminaddbook->addBook($title, $author, $year);
            echo '<div class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-600 text-white px-6 py-3 rounded shadow-lg z-50">BOOK ADDED SUCCESSFULLY</div>';
        }
    }
?>