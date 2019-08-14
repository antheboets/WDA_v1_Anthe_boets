<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");
include_once($path."database/UserDAO.php");
include_once($path."database/CommentDAO.php");
session_start();
header("location: ".$headerPath."index.php");
if($_SERVER["REQUEST_METHOD"] == 'POST') {
    if(isset($_POST['text'])  && isset($_SESSION['user']) && isset($_POST['replyId']) && isset($_POST['productId'])&& isset($_POST['url'])){
        if(!empty($_POST['text']) && !empty($_SESSION['user']) && !empty($_POST['productId']) && !empty($_POST['url'])){
            header("location: " . $_POST['url']);
            CommentDAO::create($_POST['productId'],$_POST['text'],$_SESSION['user']->id,$_POST['replyId']);
        }
    }
}
?>