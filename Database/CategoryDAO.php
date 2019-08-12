<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");
include_once($path."Data/Category.php");
include_once($path."Database/DatabaseFactory.php");
class CategoryDAO{
    public static function IsCategory($category){
        var_dump($category);
        $row = DatabaseFactory::getDatabase()->executeQuery("SELECT CategoryId FROM Categorty WHERE CategortyId = '?';", array($category->id));
        if(!is_null($row)){
            return true;
        }
        return false;
    }
    public static function getAllCategorys(){
        $rows = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Category");
        return self::convertRowsToObject($rows);
    }
    private static function convertRowsToObject($rows)
    {
        if(!is_null($rows)){
            $categorys = [];
            foreach ($rows as $row)
            {
                $categorys[] =  new Category($row['CategoryId'],$row['Name']);
            }
            return $categorys;
        }
        return NULL;
    }

}
?>