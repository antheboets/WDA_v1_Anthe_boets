<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");
include_once($path."Data/ShoppingCart.php");
include_once($path."Data/ShoppingCartItem.php");
include_once($path."Data/Category.php");
include_once($path."Database/DatabaseFactory.php");
 class ShoppingCartDAO{

     public static function getShoppingCartOfUser($userId){
        $rows = DatabaseFactory::getDatabase()->executeQuery("SELECT SH.ProductId, SH.Amount, P.Name, P.Description, P.Image, P.Price, C.CategoryId , C.Name as CategoryName FROM ShoppingCartItems as SH INNER JOIN Product as P on(SH.ProductId=P.ProductId) INNER JOIN Category as C ON (P.CategoryId=C.CategoryId) WHERE SH.UserId = '?' AND P.Archived = 0",array($userId));
        return self::convertRowsToObjectForShoppingCartSession($rows);
     }

     private static function convertRowsToObjectForShoppingCartSession($rows){
         if(!is_null($rows)){
            $items = [];
            foreach ($rows as $row){
                $category = new Category($row['CategoryId'], $row['CategoryName']);
                $product = new Product($row['ProductId'],$row['Name'],$row['Description'],$row['Image'],$row['Price'], $category,NULL,NULL,false);
                $items[] = new ShoppingCartItem($product,$row['Amount']);
            }
            return new ShoppingCart($items);
         }
         return NULL;
     }
 }
?>