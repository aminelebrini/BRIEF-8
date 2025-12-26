<?php

    class AdminMeth{

        private $conn;

        public function __construct($conn)
        {
            $this->conn;
        }

        public function addBook(string $title, string $author, string $year, string $status)
        {
            $query  = "INSERT INTO books (title , author , year, status) values(?,?,?,?)";
            $statement = $this->conn->prepare($query);
            $statement->execute([$title, $author, $year, $status = "available"]);
        }

        public function removebook(string $title, string $author, string $year, string $status)
        {
            $query = "SELECT * FROM WHERE title = ?";
            $statement = $this->conn->prepare($query);
            $statement->execute([$title]);
        }
    }



?>