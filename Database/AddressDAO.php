<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");
include_once($path."Data/Address.php");
include_once($path."Database/DatabaseFactory.php");
class AddressDAO{


    public static function create($address,$userId){
        return DatabaseFactory::getDatabase()->executeQuery("INSERT INTO Address VALUE (NULL, '?','?','?','?','?');",array($userId,$address->city,$address->street,$address->number,$address->zip));
    }

    public static function createForSale($address,$userId){
        AddressDAO::create($address,$userId);
        $row = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Address WHERE UserId = '?' AND City = '?' AND Street = '?' AND Number = '?' AND Zip = '?';",array($userId,$address->city,$address->street,$address->number,$address->zip));
        return self::convertRowToObject($row);
    }

    private static function convertRowToObject($row){
        if(!is_null($row)){
            return new Address($row['AddressId'],$row['City'],$row['Street'],$row['Number'],$row['Zip']);
        }
        return NULL;
    }
}
?>