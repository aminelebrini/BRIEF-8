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

            if ($book['status'] === 'available') {
                
            $update = "UPDATE books SET status = 'unavailable' WHERE id = ?";
            $stmt = $this->conn->prepare($update);
            $stmt->execute([$bookId]);
            $_SESSION['book'] = $book;
            
            $insert = "INSERT INTO borrows (reader_id, book_id, borrow_date, return_date) VALUES (?, ?, ?, ?)";
            $statement = $this->conn->prepare($insert);
            $statement->execute([$readerId, $bookId, $start, $end]);
            
            $_SESSION['success'] = "Book effectué avec succès !";
            }
        }
        public function returnBorrow($bookId)
        {
            $_SESSION['success'] = "Emprunt effectué avec succès !";
            $get = "SELECT book_id FROM borrows WHERE book_id=?";
            $st = $this->conn->prepare($get);
            $st->execute([$bookId]);
            $row = $st->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $statement = $this->conn->prepare("UPDATE books SET status='available' WHERE id=?");
                $statement->execute([$bookId]);
            }

            $del = "DELETE FROM borrows WHERE book_id=?";
            $statement = $this->conn->prepare($del);
            $statement->execute([$bookId]);
            
            $_SESSION['success'] = "Retour effectué avec succès !";
        }

        public function affAllReservation()
        {
            $query = "SELECT borrows.book_id, books.id, books.title, books.author,books.publication_year FROM borrows INNER JOIN books ON borrows.book_id = books.id";
            $statement = $this->conn->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
            
        }
    }

    $readerMeth = new RederMeth($conn);

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book']))
    {
        $readerid = $_SESSION['user']['id'];
        $bookid = $_POST['book'];
        $startdate = $_POST['startdate'];
        $enddate = $_POST['enddate'];
        $readerMeth->BorrowBook($readerid, $bookid, $startdate, $enddate);
        header("Location: /books");
        exit();
        
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['removebtn'])) {
        $bookId = $_POST['removebtn'];
        $readerMeth->returnBorrow($bookId);
        header("Location: /books");
        exit();
        
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['show']))
    {
        $readerMeth->affAllReservation();
    }
?>