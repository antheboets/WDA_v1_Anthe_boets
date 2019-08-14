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

        private static function getUrl(){
            return "http://dtsl.ehb.be/~anthe.boets/eShop/";
        }

        public function drawComment($level){
            $level++;
            if($level % 2 == 0 ){
                $classTheme = "commentLight";
            }
            else{
                $classTheme = "commentDark";
            }
            echo "<div class='comment ".$classTheme."' id='".$this->id."'>";
                echo "<div class='row'>";
                    echo "<div class='col-md-2'>";
                        echo "<p class='noBreak commentInfo'>Name: ".$this->user."</p>";
                        echo "<p class='noBreak commentInfo'>Rating: ".$this->rating."/10</p>";
                        echo "<p class='noBreak commentInfo'>Time: ".$this->creationTime."</p>";
                        echo "<button class='commentInfo'><a href='".$this->getUrl()."'>reply</a></button>";
                    echo "</div>";
                    echo "<div class='commentText col-md-10'>";
                        echo "<p class='noBreak'>".$this->text."</p>";
                    echo "</div>";
                echo "</div>";
                echo "<div class='replys'>";
                    if(!empty($this->replys)){
                        foreach ($this->replys as $reply){
                            $reply->drawComment($level);
                        }
                    }
                echo "</div>";
            echo "</div>";
        }
    }

?>


