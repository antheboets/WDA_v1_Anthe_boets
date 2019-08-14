<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");
include_once($path."database/UserDAO.php");
include_once($path."database/RatingDAO.php");
session_start();
header("location: ".$headerPath."index.php");
if($_SERVER["REQUEST_METHOD"] == 'POST') {

    if(isset($_POST['productId'])  && isset($_POST['rate']) && isset($_POST['rating']) && isset($_POST['urlRating'])){
        if(!empty($_POST['productId']) && !empty($_POST['rate']) &&!empty($_POST['rating']) && !empty($_POST['urlRating'])){
            header("location: " . $_POST['urlRating']);
            $error = [];
            if(is_numeric($_POST['rate'])){
            $error[] = "rating isn't a number";
            }


            if(empty($error)){
                $rating = new Rating(RatingDAO::isRatingId($_POST['productId'], $_SESSION['user']->id),$_POST['rating'], $_SESSION['user']->id);

                if($rating->id != 0){

                    RatingDAO::updateRating($rating,$_SESSION['user']->id,$_POST['productId']);
                }
                else{
                    RatingDAO::createRating($rating,$_SESSION['user']->id,$_POST['productId']);
                }
            }
        }
    }
}

?>