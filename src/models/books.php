<?php
    class books{
        private $id;
        private $title;
        private $author;
        private $year;
        private $status;

        

        public function __construct($id, $title, $author, $year, $status)
        {
            $this->id = $id;
            $this->title = $title;
            $this->author = $author;
            $this->year  = $year;
            $this->status = $status;
        }

        public function get_book_id()
        {
            return $this->id;
        }
        public function get_title(){
            return $this->title;
        }
        public function get_author(){
            return $this->author;
        }
        public function get_year(){
            return $this->year;
        }
        public function get_status(){
            return $this->status;
        }
    }
?>