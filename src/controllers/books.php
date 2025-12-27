<?php
include_once __DIR__ . "/../data/connect_db.php";
include_once __DIR__ . "/../models/books.php";

class Book {

    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getBooks()
    {
        $query = "SELECT * FROM books";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        $books = [];
        
        foreach($rows as $row)
        {
            $books[] = new Books(
            $row['id'],
            $row['title'],
            $row['author'],
            $row['publication_year'],
            $row['status']);
        }
        $_SESSION['books'] = $books;

    }


    public function isAvailable()
    {
        $query = "SELECT * FROM books WHERE status = ? ";
        $statement = $this->conn->prepare($query);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}

$bookModel = new Book($conn);

$books = $bookModel->getBooks();
?>
