<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");

include_once($path."database/UserDAO.php");
include_once($path."database/ProductDAO.php");
if(!isLogedIn()){
	include_once($path."Logic/autoLogin.php");
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>eShop</title>
        <?php
            include($path."/UI/component/favicon.php");
        ?>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
		<script src="UI/js/lib.js"></script>
		<script src="UI/js/header.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css"  href="UI/css/header.css">
		<link rel="stylesheet" type="text/css"  href="UI/css/index.css">
	</head>
	<body>
		<script>
			<?php
				$bool = !isLogedIn() ? 'true' : 'false';
				echo 'function isLogedIn(){';
				echo 'return '. $bool .';';
				echo '}';
				if(isLogedIn()){

                }
			?>
				
		</script>
		<?php 
			include($path."/UI/component/header.php");
		?>
		<div class="container">
            <div class="row">
                <div class='col-md-4'>
                    <h1>eShop</h1>
                </div>
            </div>
            <div class="row">
                <div class='col-md-4'>
                    <h2>Newst Products</h2>
                </div>
                <div class='col-md-4'>
                    <h2>Random Products</h2>
                </div>
                <?php
                $amount = 4;
                $listNew = ProductDAO::getLatestByAmout($amount);
                $listRandom = ProductDAO::getRandomByAmout($amount);
                foreach ($listNew as $item){
                    $item->drawMainMenu();
                }foreach ($listRandom as $item){
                    $item->drawMainMenu();
                }
                ?>
        </div>
	</body>
</html>
