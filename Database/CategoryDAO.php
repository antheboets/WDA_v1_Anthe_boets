<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");
include_once($path."Data/Category.php");
include_once($path."Database/DatabaseFactory.php");
class CategoryDAO{
    public static function IsCategory($categorty){
        $result = DatabaseFactory::getDatabase()->executeQuery("SELECT CategoryId FROM Categorty WHERE CategortyId = '?';", array($categorty->Id));
        if(!is_null($result)){
            return self::convertRowToObject(mysqli_fetch_array($result));
        }
        return false;
    }
}
?>