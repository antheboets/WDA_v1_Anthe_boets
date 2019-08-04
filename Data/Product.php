<?php
    class Product{
        public $id;
        public $name;
        public $desc;
        public $image;
        public $price;
        public $categorie;
        public $rating;
        public $comments;

        public function __construct($id, $name, $desc, $image, $price, $categorie, $rating, $comments)
        {
            $this->id = $id;
            $this->name = $name;
            $this->desc = $desc;
            $this->image = $image;
            $this->price = $price;
            $this->categorie = $categorie;
            $this->rating = $rating;
            $this->comments = $comments;
        }




    }
?>