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

        public function removebook(int $bookId)
        {
            $query = "DELETE FROM books WHERE id = ?";
            $statement = $this->conn->prepare($query);
            $statement->execute([$bookId]);
        }

        public function updateBook($book_id, $title, $author, $year)
        {
            $query = "UPDATE books SET title = ?, author = ?, publication_year = ? WHERE id = ?";

            $statement = $this->conn->prepare($query);            
            $statement->execute([$title, $author, $year, $book_id]);
        }

        function display_all_reservation()
        {
            $query = "SELECT users.firstname,
                    users.lastname,
                    books.title,
                    books.author,
                    borrows.borrow_date,
                    borrows.return_date
                    FROM borrows
                    INNER JOIN users ON borrows.reader_id = users.id
                    INNER JOIN books ON borrows.book_id = books.id";
            
            $statement = $this->conn->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public function allusers()
        {
            $query = "SELECT * FROM users WHERE role = 'reader'";
            $statement = $this->conn->prepare($query);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

    }

    $adminbook = new AdminMeth($conn);

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addbook']))
    {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $year = $_POST['publication_year'];

        if(!empty($title) && !empty($author) && !empty($year))
        {
            $adminbook->addBook($title, $author, $year);
            echo '<div class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-600 text-white px-6 py-3 rounded shadow-lg z-50">BOOK ADDED SUCCESSFULLY</div>';
        }
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['removebook']))
    {
        $bookId = $_POST['book_id'];
        $adminbook->removebook($bookId);
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update']))
    {
        $book_id = $_POST['book_id'];
        $newTitle = $_POST['title'];
        $newAuthor = $_POST['author'];
        $newYear = $_POST['year'];

        $adminbook->updateBook($book_id,$newTitle,$newAuthor,$newYear);
    }

    $adminbook->allusers();



?>