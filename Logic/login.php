<?php
	session_start();
    include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");
	include_once($path."database/UserDAO.php");



    header("location: ".$headerPath."index.php");
	if($_SERVER["REQUEST_METHOD"] == 'POST') {
        if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['url'])) {
            if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['url'])) {

                header("location: " . $_POST['url']);

                $emailCheck = true;
                //checkEmail;

                if (isset($_POST['stayLogedIn'])) {
                    setcookie('autoLogin', $_POST['email'], 2147483647, "/");
                }

                if (!validateEmail($_POST['email'])) {
                    $emailCheck = false;
                }

                if ($emailCheck) {

                    $salt = UserDAO::getSaltFromUser($_POST['email']);
                    $hash = hash('sha512', $_POST['password'] . $salt);
                    $user = UserDAO::checkCredentials($_POST['email'], $hash);




                    if (!is_null($user)) {
                        $_SESSION['user'] = $user;
                    }
                }
            }
        }
    }

?>