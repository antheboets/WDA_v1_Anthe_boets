<?php
    include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");
	include_once($path."Database/Database.php");
	class DatabaseFactory{


		private static $con;

		public static function getDatabase(){

			if(self::$con == null){
				$url = "dt5.ehb.be";
				$user = "1819WEBADV040";
				$pass = "dedo86";
				$db = "1819WEBADV040";
				self::$con = new Database($url, $user, $pass, $db);
			}
            return self::$con;
        }
	}
?>