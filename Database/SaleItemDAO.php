<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");
include_once($path."Data/SaleItem.php");
include_once($path."Database/DatabaseFactory.php");
class SaleItemDAO{
    public static function createMultiple($items,$saleId){
        if(!empty($items)){
            $sqlString = "";
            $param = [];
            foreach ($items as $item) {
                $sqlString += "( '?' ,'?','?'),";
                $param[] = $saleId;
                $param[] = $item->product->id;
                $param[] = $item->amount;
            }
            $sqlString = substr($sqlString,0,-1);
            $sqlString += ";";
            return  DatabaseFactory::getDatabase()->executeQuery("INSERT INTO SaleItems VALUES" . $sqlString,$param);
        }
        else{
            return false;
        }
    }
}
?>