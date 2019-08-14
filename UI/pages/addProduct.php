<?php

include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");

include_once($path."database/UserDAO.php");
include_once($path."database/ProductDAO.php");
session_start();
if(!isLogedIn()){
    header("location: ".$headerPath."index.php");
}
if(!$_SESSION['user']->admin){
    header("location: ".$headerPath."index.php");
}
$categorys = CategoryDAO::getAllCategorys();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>eShop</title>
        <<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <script src="<?php echo $url; ?>UI/js/lib.js"></script>
        <script src="<?php echo $url; ?>UI/js/header.js"></script>
        <script src="<?php echo $url; ?>UI/js/addProduct.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css"  href="<?php echo $url; ?>UI/css/header.css">
        <link rel="stylesheet" type="text/css"  href="<?php echo $url; ?>UI/css/index.css">
    </head>
    <body>
        <script>
            <?php
            $bool = !isLogedIn() ? 'true' : 'false';
            echo 'function isLogedIn(){';
            echo 'return '. $bool .';';
            echo '}';
            echo "let url = '".$url."';";
            ?>

        </script>
        <?php
        include($path."/UI/component/header.php");
        ?>
        <h1>Create Product</h1>
        <form method="post" action="<?php echo $url; ?>logic/createProduct.php" id="ProductForm" enctype="multipart/form-data">
            <p class="noBreak">Name: <spam class="error" id="EName"></spam></p>
            <input type="text" id="IName" name="name">
            <p class="noBreak">Description: <spam class="error" id="EDescription"></spam></p>
            <textarea rows="10" cols="100" id="IDescription" name="description" form="ProductForm"></textarea>
            <p class="noBreak">Image: <spam class="error" id="EImage"></spam></p>
            <input type="file" name="files[]" id="IImage" accept=".jpg, .jpeg, .png">
            <p class="noBreak">Category: <spam class="error" id="ECategory"></spam></p>
            <select name="category" id="ICategory" form="ProductForm">
                <?php
                foreach ($categorys as $category){
                    $category->drawOption();
                }
                ?>
            </select>
            <p class="noBreak">Price: <spam class="error" id="EPrice"></spam></p>
            <input type="text"  id="IPrice" name="price">
            <br>
            <input type="submit" name="Create">
        </form>

    </body>
</html>

