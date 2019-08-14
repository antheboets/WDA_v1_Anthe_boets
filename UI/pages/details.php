<?php

include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");
include_once($path."database/UserDAO.php");
session_start();
include_once($path."database/ProductDAO.php");
if(!isLogedIn()){
    include_once($path."Logic/autoLogin.php");
}

if($_SERVER["REQUEST_METHOD"] === 'GET') {
    if(isset($_GET['id'])){
        if(!empty($_GET['id'])){
            $product = ProductDAO::getById($_GET['id']);


$userRating = 10;
if(isLogedIn()){
    foreach ($product->rating as $ratings){
        if($ratings->userId == $_SESSION['user']->id){
            $userRating = $ratings->rating;
            break;
        }
    }
}
//forea ($product->rating as $ratings){

//}
?>
<!DOCTYPE html>
<html>
<head>
    <title>eShop</title>
    <?php
    include($path."/UI/component/favicon.php");
    ?>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="<?php echo $url; ?>UI/js/lib.js"></script>
    <?php
    include_once($path."Logic/headerJsImport.php");
    ?>
    <script src="<?php echo $url; ?>UI/js/addToCart.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"  href="<?php echo $url; ?>UI/css/header.css">
    <link rel="stylesheet" type="text/css"  href="<?php echo $url; ?>UI/css/details.css">
    <link rel="stylesheet" type="text/css"  href="<?php echo $url; ?>UI/css/product.css">
</head>
<body>
<?php
include($path."/UI/component/header.php");
?>
<div class="container">
    <div class="row">
        <div class='col-md-4'>
            <h1>Product details</h1>
        </div>
    </div>
</div>
    <?php
        $product->drawDetail($maxRating,$userRating);
    ?>
    <?php
        $product->drawComments();
    ?>
<script src="<?php echo $url; ?>UI/js/details.js"></script>
</body>
</html>
        <?php

        }
        else{
            header("location: ".$headerPath."index.php");
        }
    }
    else{
        header("location: ".$headerPath."index.php");
    }
}
else{
    header("location: ".$headerPath."index.php");
}