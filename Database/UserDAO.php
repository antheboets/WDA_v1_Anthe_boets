<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");
include_once($path."Data/User.php");
include_once($path."Database/DatabaseFactory.php");
include_once($path."Database/ShoppingCartDAO.php");
class UserDAO{
    public static function getAll()
    {
        $results = DatabaseFactory::getDatabase()->executeQuery("SELECT UserId,Name,Email FROM User");
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++){
            $row = $results->fetch_array();
            $resultsArray[$i] = self::convertRowToObject($row);
        }
        return $resultsArray;
    }

    public static function checkEmail($email)
    {

        $result = DatabaseFactory::getDatabase()->executeQuery("SELECT Email FROM User WHERE Email = '?';", array($email));
        $row = $result->fetch_array();
        if(!is_null($row)){
            return true;
        }
        return false;
    }

    public static function getById($id)
    {
        $result = DatabaseFactory::getDatabase()->executeQuery("SELECT UserId,Name,Email  FROM User WHERE UserId = ?;", array($id));
        return self::convertRowToObject(mysqli_fetch_array($result));
    }

    public static function checkCredentials($email,$hash)
    {
        $result = DatabaseFactory::getDatabase()->executeQuery("SELECT UserId, FirstName, LastName, Email, Admin FROM User WHERE Email = '?' AND Hash = '?';", array($email,$hash));
        if(!is_null($result)){
            return self::convertRowToObject(mysqli_fetch_array($result));
        }
        return false;
    }

    public static function delete($user)
    {
        return DatabaseFactory::getDatabase()->executeQuery("DELETE FROM User WHERE UserId = ?;", array($user->Id));
    }

    public static function getByEmail($email)
    {
        $result = DatabaseFactory::getDatabase()->executeQuery("SELECT UserId,FirtName,LastName,Email,Admin  FROM User WHERE Email = '?';", array($email));
        return self::convertRowToObject($result);
    }

    public static function update($user)
    {
        if(self::checkEmail($user->email)){
            return DatabaseFactory::getDatabase()->executeQuery("UPDATE User SET Name = '?', email = '?' WHERE UserId = ?;", array($user->username,$user->email,$user->id));
        }
        return false;
    }

    public static function getSaltFromUser($email)
    {
        $result = DatabaseFactory::getDatabase()->executeQuery("SELECT Salt FROM User WHERE Email = '?';", array($email));
        if(!is_null($result)){
            $row = $result->fetch_array();
            return $row['Salt'];
        }
        return NULL;
    }

    public static function create($user,$pass,$salt)
    {
        return DatabaseFactory::getDatabase()->executeQuery("INSERT INTO User VALUES (NULL,'?','?','?','?','?',sysdate(), '?')",array($user->firstName,$user->lastName,$pass,$salt,$user->email,(int)$user->admin));
    }

    private static function convertRowToObject($row)
    {
        if(!is_null($row)){
            $shoppingCart = ShoppingCartDAO::getShoppingCartOfUser($row['UserId']);
            return new User($row['UserId'],$row['Email'],$row['FirstName'],$row['LastName'],$shoppingCart,($row['Admin'] == 1 ? true : false));
        }
        return NULL;
    }

    /*private static function convertRowToObjectWithoutEmail($row){
        if(!is_null($row)){
            return new User($row['UserId'],NULL,$row['Name']);
        }
        return NULL;
    }*/

}
?>