<?php
    include_once __DIR__ . "/../models/user.php";
    
    class RederMeth{

        private $conn;

        public function __construct($conn)
        {
            $this->conn = $conn;
        }

        public function BorrowBook(int $readerId, int $bookId, string $start, string $end)
        {
            $query = "SELECT * FROM books WHERE id = ?";
            $statement = $this->conn->prepare($query);
            $statement->execute([$bookId]);
            $book = $statement->fetch(PDO::FETCH_ASSOC);

            if ($book && $book['status'] === 'available') 
            {
                $update = "UPDATE books SET status = 'unavailable' WHERE id = ?";
                $stmt = $this->conn->prepare($update);
                $stmt->execute([$bookId]);

                $_SESSION['book'] = $book;
            }
            $insert = "INSERT INTO borrows (reader_id, book_id, borrow_date, return_date) VALUES (?, ?, ?, ?)";

            $statement = $this->conn->prepare($insert);
            $statement->execute([$readerId, $bookId, $start, $end]);
        }

        public function returnBorrow(int $borrowid):void{
            $query = "DELETE FROM borrowbook WHERE id = ?";
            $statement = $this->conn->prepare($query);
            $statement->execute([$borrowid]);

        }
    }

    $readerMeth = new RederMeth($conn);

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book']))
    {
        $readerid = $_SESSION['user']['id'];
        $bookid = $_POST['bookid'];
        $startdate = $_POST['startdate'];
        $enddate = $_POST['enddate'];

        $readerMeth->BorrowBook($readerid, $bookid, $startdate, $enddate);
    }
?>