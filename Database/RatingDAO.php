<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");
include_once($path."Data/Rating.php");
class RatingDAO{
    public static function getAllRatingsOfProduct($ProductId){
        $rows = DatabaseFactory::getDatabase()->executeQuery( "SELECT * FROM Rating WHERE ProductId = '?';",array($ProductId));
        return self::convertRowToObject($rows);
    }

    public static function isRatingId($productId,$userId){
        $row = DatabaseFactory::getDatabase()->executeQuery("SELECT RatingId FROM Rating WHERE ProductId = '?' AND UserId = '?';", array($productId, $userId));
        //$row = $result->fetch_array();
        if (!is_null($row)) {
            return $row['RatingId'];
        }
        return false;
    }

    public static function updateRating($rating,$userId,$productId){
        $result = DatabaseFactory::getDatabase()->executeQuery("UPDATE Rating SET Rating ='?' WHERE RatingId = '?'AND UserId='?' AND ProductId='?';",array($rating->rating,$rating->id,$userId,$productId));
        return $result;
    }
    public static function createRating($rating,$userId,$productId){
        $result = DatabaseFactory::getDatabase()->executeQuery("INSERT INTO Rating VALUES RatingId= '?', Rating = '?', UserId='?', ProductId='?';",array($rating->id,$rating->rating,$userId,$productId));
        return $result;
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