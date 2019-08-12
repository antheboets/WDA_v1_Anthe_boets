<?php
	session_start();
    include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");
	setcookie('autoLogin','',time()-3600,"/");
	session_destroy();
	header("location: ".$headerPath."index.php");
?>