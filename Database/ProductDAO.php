<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");
include_once($path."Data/Product.php");
include_once($path."Database/DatabaseFactory.php");
include_once($path."Database/RatingDAO.php");
include_once($path."Database/CategoryDAO.php");
include_once($path."Database/CommentDAO.php");
class ProductDAO
{
    public static function create($product)
    {
        var_dump(array($product->name,$product->description,$product->image,$product->price,$product->category->id));
        return DatabaseFactory::getDatabase()->executeQuery("INSERT INTO Product VALUES (NULL,'?','?','?','?','?',0,SYSDATE());", array($product->name,$product->description,$product->image,$product->price,$product->category->id));
    }
    /*
    public static function getAll(){
        $row = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Product as P INNER JOIN Category as CA on(P.CategoryId=CA.CategoryId) WHERE P.ProductId = '?';",array($));
        return self::convertRowToObjectFull($row);
    }*/
    public static function getById($porductId)
    {
        $row = DatabaseFactory::getDatabase()->executeQuery("SELECT P.*, C.CategoryId, C.Name as CategoryName FROM Product as P INNER JOIN Category as CA on(P.CategoryId=CA.CategoryId) WHERE P.ProductId = '?';",array($porductId));
        return self::convertRowToObjectFull($row);
    }
    public static function archive($product)
    {
        return DatabaseFactory::getDatabase()->executeQuery("UPDATE Product SET Archived = '?' WHERE ProductId = '?';", array($product->id,$product->archived));
    }
    public static function update($product)
    {
        return DatabaseFactory::getDatabase()->executeQuery("UPDATE Product SET Name = '?', Description = '?', Image = '?', Price = '?',CategoryId= '?',Archived = '?' WHERE UserId = '?';", array($product->name,$product->description,$product->image,$product->price,$product->categorie->id,$product->id));
    }
    public static function getNameForSearch($name)
    {
        return DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Product WHERE Name LIKE '%?%' AND Archived = 0;", array($name));
    }
    public static function getAllSmall()
    {
        $rows =  DatabaseFactory::getDatabase()->executeQuery("SELECT P.*, C.CategoryId, C.Name as CategoryName  FROM Product AS P INNER JOIN Category AS C ON(P.CategoryId=C.CategoryId) WHERE P.Archived = 0;",array());
        return self::convertRowsToObjectSmall($rows);
    }
    public static function getAllFull()
    {
        $rows =  DatabaseFactory::getDatabase()->executeQuery("SELECT P.*, C.CategoryId, C.Name as CategoryName FROM Product AS P INNER JOIN Category AS C ON(P.CategoryId=C.CategoryId) WHERE P.Archived = 0;",array());
        return self::convertRowsToObjectFull($rows);
    }
    public static function getLatestByAmout($amount)
    {
        $rows = DatabaseFactory::getDatabase()->executeQuery("SELECT P.*, C.CategoryId, C.Name as CategoryName FROM Product AS P INNER JOIN Category AS C ON (P.CategoryId=C.CategoryId) WHERE P.Archived = 0 ORDER BY P.CreationDate DESC LIMIT ?;",array($amount));
        return self::convertRowsToObjectSmall($rows);
    }
    public static function getRandomByAmout($amount)
    {
        $rows = DatabaseFactory::getDatabase()->executeQuery("SELECT P.*,C.CategoryId, C.Name as CategoryName  FROM Product AS P INNER JOIN Category AS C ON(P.CategoryId=C.CategoryId) WHERE P.Archived = 0 ORDER BY RAND() LIMIT ?;",array($amount));
        return self::convertRowsToObjectSmall($rows);
    }
    public static function IsNameTaken($name)
    {
        $result = DatabaseFactory::getDatabase()->executeQuery("SELECT Name FROM Product WHERE Name LIKE '%?%';", array($name));
        $row = $result->fetch_array();
        if(!is_null($row)){
            return true;
        }
        return false;
    }
    private static function convertRowToObjectFull($row)
    {
        if(!is_null($row)){
            $comments = CommentDAO::getAllCommentsOfProduct($row['ProductId']);
            $category = new Category($row['CategoryId'], $row['CategoryName']);
            $ratings = RatingDAO::getAllRatingsOfProduct($row['ProductId']);

            return new Product($row['ProductId'],$row['Name'],$row['Description'],$row['Image'],$row['Price'], $category,$ratings,$comments,false);
        }
        return NULL;
    }
    private static function convertRowToObjectSmall($row)
    {
        if(!is_null($row)){
            $category = new Category($row['CategoryId'], $row['CategoryName']);
            $ratings = RatingDAO::getAllRatingsOfProduct($row['ProductId']);

            return new Product($row['ProductId'],$row['Name'],$row['Description'],$row['Image'],$row['Price'], $category,$ratings,NULL,false);
        }
        return NULL;
    }
    private static function convertRowsToObjectFull($rows)
    {
        if(!is_null($rows)){
            $poducts = [];
            foreach ($rows as $row)
            {
                $comments = CommentDAO::getAllCommentsOfProduct($row['ProductId']);
                $category = new Category($row['CategoryId'], $row['CategoryName']);
                $ratings = RatingDAO::getAllRatingsOfProduct($row['ProductId']);
                $poducts[] =  new Product($row['ProductId'],$row['Name'],$row['Description'],$row['Image'],$row['Price'], $category,$ratings,$comments,false);
            }
            return $poducts;
        }
        return NULL;
    }
    private static function convertRowsToObjectSmall($rows)
    {
        if(!is_null($rows)){
            $poducts = [];
            foreach ($rows as $row)
            {
                $category = new Category($row['CategoryId'], $row['CategoryName']);
                $ratings = RatingDAO::getAllRatingsOfProduct($row['ProductId']);

                $poducts[] = new Product($row['ProductId'],$row['Name'],$row['Description'],$row['Image'],$row['Price'], $category,$ratings,NULL,false);
            }
            return $poducts;
        }
        return NULL;
    }
}