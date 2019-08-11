<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");
include_once($path."Data/Rating.php");
    class Comment{
        public $id;
        public $text;
        public $user;
        public $rating;
        public $replys;
        public $creationTime;

        public function __construct($id, $text, $user, $rating, $replys, $creationTime)
        {
            $this->id = $id;
            $this->text = $text;
            $this->user = $user;
            $this->rating = $rating;
            $this->replys = $replys;
            $this->creationTime = $creationTime;
        }


    }
?>