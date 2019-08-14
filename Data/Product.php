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

        private static function getUrl(){
            return "http://dtsl.ehb.be/~anthe.boets/eShop/";
        }

        public function drawMainMenu(){
            echo "<div id='".$this->id."' class='Product'>";
            echo "<a href='". $this::getUrl() ."UI/pages/details.php?id=".$this->id."'>";
            $this->drawImage(200,0,$this->name, "col-md-12 ProductImg");
            echo "<p class='noBreak ProductText'>Name: ".$this->name."</p>";
            echo "<p class='noBreak ProductText'>Price: ".$this->price."</p>";
            echo "<p class='noBreak ProductText'>Categorty: ".$this->category->name."</p>";
            if(sizeof($this->rating) == 0){
                echo "<p class='noBreak ProductText'>Rating: None</p>";
            }
            else{
                echo "<p class='noBreak ProductText'>Rating: ".$this->calcRating()."/10</p>";
            }
            echo "<button class='buyBtn ProductText'><a>Buy</a></button>";
            echo "</a>";
            echo "</div>";
        }

        public function calcRating(){
            $total = 0;
            if(sizeof($this->rating) == 0){
                return 0;
            }
            foreach ($this->rating as $item){
                $total += $item->rating;
            }
            $total = $total / sizeof($this->rating);
            return round($total);
        }
        public function drawImage($height, $width, $alt, $class){
            $base64 = 'data:image/;base64,' . base64_encode($this->image);
            echo "<img ";
            if($class != ""){
                echo "class='".$class."'";
            }
            if($height !=0){
                echo "height='" .$height."'";
            }
            if($width !=0){
                echo "width='".$width."'";
            }
            echo "alt='".$alt."' src='".$base64."'/>";
        }
    }
?>