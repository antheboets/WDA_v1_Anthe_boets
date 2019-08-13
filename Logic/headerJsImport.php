<?php
error_reporting(1);
//var_dump($_SESSION['user']);
?>
<script>
    <?php
    $bool = !isLogedIn() ? 'true' : 'false';
    echo 'function isLogedIn(){';
    echo 'return '. $bool .';';
    echo '}';
    if($bool)
    {
        echo 'function isAdmin(){';
        echo 'return '.$_SESSION['user']->admin.';';
        echo '}';
        echo 'function getNameUser(){';
        echo "return '".$_SESSION["user"]->firstName." ".$_SESSION["user"]->lastName."';";
        echo '}';
    }
    else{
        echo 'function isAdmin(){';
        echo 'return false';
        echo '}';
    }
    ?>
</script>
<script src="<?php echo $url; ?>UI/js/header.js"></script>