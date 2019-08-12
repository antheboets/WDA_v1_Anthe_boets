<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");
include_once($path."Data/Sale.php");
include_once($path."Database/DatabaseFactory.php");
include_once($path."Database/SaleItemDAO.php");
include_once($path."Database/AddressDAO.php");
class SaleDAO{

    public static function create($sale){
        $returnVal = DatabaseFactory::getDatabase()->executeQuery("INSERT INTO Sale VALUES (NULL,'?','?','?','?','?',sysdate());",array($sale->user->id,$sale->billingAddress));
        $saleFromDb = DatabaseFactory::getDatabase()->executeQuery("SELECT SaleId FROM Sale WHERE UserId='?' AND DeliveryMethod = '?' AND PaymentMethod = '?' AND Date = '?';",array($sale->user->id,$sale->billingAddress));
        SaleItemDAO::createMultiple($sale->saleItems,$saleFromDb);
        return $returnVal;
    }

    public static function getSale(){

    }


    private static function convertRowToObject($row){
        if(!is_null($row)){
            return new User($row['UserId'],$row['FirstName'],$row['LastName'],$row['Email'],$row['FirstName'],$row['FirstName']);
        }
        return NULL;
    }

}

?>