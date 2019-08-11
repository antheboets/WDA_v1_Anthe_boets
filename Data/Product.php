<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");
include_once($path."Data/Category.php");
    class Product{
        public $id;
        public $name;
        public $description;
        public $image;
        public $price;
        public $category;
        public $rating;
        public $comments;
        public $archived;

        public function __construct($id, $name, $description, $image, $price, $category, $rating, $comments, $archived)
        {
            $this->id = $id;
            $this->name = $name;
            $this->description = $description;
            $this->image = $image;
            $this->price = $price;
            $this->category = $category;
            $this->rating = $rating;
            $this->comments = $comments;
            $this->archived = $archived;
        }




    }
?>