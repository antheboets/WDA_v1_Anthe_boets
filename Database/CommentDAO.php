<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");
include_once($path."Data/Comment.php");
include_once($path."Data/Rating.php");
class CommentDAO{
    public static function getAllCommentsOfProduct($ProductId){
        $rows = DatabaseFactory::getDatabase()->executeQuery( "SELECT C.*, U.FirstName, U.LastName , R.Rating FROM Comment AS C INNER JOIN User AS U ON(C.UserId=U.UserId) INNER JOIN Rating AS R ON(C.ProductId=R.ProductId AND C.UserId=R.UserId) WHERE C.ProductId = '?' ORDER BY CreationTime ASC",array($ProductId));
        return self::convertRowToObject($rows);
    }

    private static function convertRowToObject($rows){
        if(!is_null($rows)){
            $comments = [];
            $foundReplyHost = false;
            foreach ($rows as $row){
                if(!is_null($row['ReplyId'])) {
                    for($i = 0; $i < sizeof($comments); $i++ ){
                        if($comments[$i]->id == $row['ReplyId']){
                            $foundReplyHost = true;
                            $replyComment = new Comment($row['CommentId'],$row['Text'],$row['FirstName'] . $row['LastName'],$row['Rating'],[],$row['CreationTime']);
                            $comments[$i]->replys[] = $replyComment;
                            break;
                        }
                    }
                    if(!$foundReplyHost){
                        $comments[] = new Comment($row['CommentId'],$row['Text'],$row['FirstName'] . $row['LastName'],$row['Rating'],[],$row['CreationTime']);
                    }
                }
                else{
                    $comments[] = new Comment($row['CommentId'],$row['Text'],$row['FirstName'] . $row['LastName'],$row['Rating'],[],$row['CreationTime']);
                }
            }
            return $comments;
        }
        return NULL;
    }
}
?>