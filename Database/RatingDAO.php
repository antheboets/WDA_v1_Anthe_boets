<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");
include_once($path."Data/Rating.php");
class RatingDAO{
    public static function getAllRatingsOfProduct($ProductId){
        $rows = DatabaseFactory::getDatabase()->executeQuery( "SELECT * FROM Rating WHERE ProductId = '?';",array($ProductId));
        return self::convertRowToObject($rows);
    }


    private static function convertRowToObject($rows){
        if(!is_null($rows)){
            $ratings = [];
            foreach ($rows as $row){
                $ratings[] = new Rating($row['RatingId'],$row['Rating'],$row['UserId']);
            }
            return $ratings;
        }
        return NULL;
    }
}

?>