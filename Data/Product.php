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
        public function drawDetail($maxRating, $userRating){
            echo "<div class='container'>";
            echo "<div class='row'>";
                $this->drawImage(500,0,$this->name, "col-md-6 detailImg");
            echo "<div class='col-md-6' id='".$this->id."'>";
            echo "<h2>Name: ".$this->name."</h2>";
            echo "<p class='noBreak'>Categorty: ".$this->category->name."</p>";
            //echo "<div class='row'>";
            echo "<p class='noBreak'>Description: ".$this->description."</p>";
            //echo "</div>";
            if(sizeof($this->rating) == 0){
                echo "<p class='noBreak'>Rating: None</p>";
            }
            else{
                echo "<p class='noBreak'>Rating: ".$this->calcRating()."/10</p>";
            }
            echo "<form action='".$this->getUrl() ."Logic/RateProduct.php' method='post' id='ratingForm'>";
            echo "<select name='rating' form='ratingForm'>";
            for ($i = 1; $i < ($maxRating + 1); $i++) {
                if (!isLogedIn()) {
                    echo "<option value='" . $i . "'>" . $i . "</option>";
                } else {
                    if ($i == $userRating) {
                        echo "<option value='" . $i . "'  selected='selected'>" . $i . "</option>";
                    } else {
                        echo "<option value='" . $i . "'>" . $i . "</option>";
                    }
                }
            }
            echo "<input type='hidden' name='urlRating' id='urlRating'>";
            echo "<input type='hidden' name='userId' value='". $_SESSION["user"]->id ."'>";
            echo "<input type='hidden' name='productId' value='". $this->id ."'>";
            echo "<input type='submit' name='rate' value='Rate'>";
            echo "</form>";
            echo "<p class='noBreak'>Price: ".$this->price."</p>";
            echo "<p class='noBreak'><spam class='error' id='EBuyAmount'></spam></p>";
            echo "<input type='text' name='buyAmount' id='buyAmount'>";
            echo "<button class='buyBtn ProductText'>Buy</button>";
            echo "</div>";
        }
        public function drawComments(){
            echo "<div class='container' id='comments'>";
            if(sizeof($this->comments) == 0){
                echo "<h2>No Comments</h2>";
            }
            else{
                echo "<h2>Comments:</h2>";
            }
            echo "<div id='replyInfo' style='display: none;'>";
            echo "<p class='noBreak' id='replyName'>Name: </p>";
            echo "<p class='noBreak' id='replyText'>Text: </p>";
            echo "<button id='replyClearBtn'>Clear reply</button>";
            echo "</div>";
            echo "<form action='".$this->getUrl()."Logic/addComment.php' method='post' id='commentForm'>";
            echo "<textarea rows='8' cols='80' name='text' form='commentForm'></textarea>";
            echo "<input type='hidden' name='productId' value='".$this->id."'>";
            echo "<input type='hidden' name='replyId' id='replyId' value='0'>";
            echo "<input type='hidden' name='url' id='urlComment'>";
            echo "<br>";
            echo "<input type='submit' value='send'>";
            echo "</form>";
            foreach ($this->comments as $comment){
                $comment->drawComment(1);
            }
            echo "</div>";
        }
    }
?>