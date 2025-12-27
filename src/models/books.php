<?php
    class books{
        private $title;
        private $author;
        private $year;
        private $status;

        

        public function __construct($title, $author, $year, $status)
        {
            $this->title = $title;
            $this->author = $author;
            $this->year  = $year;
            $this->status = $status;
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