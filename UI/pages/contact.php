<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");

?>
<!DOCTYPE html>
<html>
<head>
    <title>eShop</title>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="<?php echo $url; ?>UI/js/lib.js"></script>
    <?php
    include($path."Logic/headerJsImport.php");
    ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"  href="<?php echo $url; ?>UI/css/header.css">
</head>
    <body>
    <?php include($path."UI/component/header.php"); ?>
    <form method="POST" action="<?php echo $url; ?>logic/mail.php" id="mailForm">
        <p class="noBreak">email</p>
        <input type="text" name="email">
        <input type="text" name="header">
        <textarea rows="10" cols="100" name="body" form="mailForm"></textarea>
        <input type="submit" name="send" value="Send">
    </form>
    </body>
</html>
