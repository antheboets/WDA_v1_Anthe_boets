<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");
include_once($path."Data/Comment.php");
include_once($path."Data/Rating.php");
class CommentDAO{
    public static function getAllCommentsOfProduct($ProductId){
        $rows = DatabaseFactory::getDatabase()->executeQuery( "SELECT C.*, U.FirstName, U.LastName , R.Rating FROM Comment AS C INNER JOIN User AS U ON(C.UserId=U.UserId) INNER JOIN Rating AS R ON(C.ProductId=R.ProductId AND C.UserId=R.UserId) WHERE C.ProductId = '?' ORDER BY CreationTime ASC;",array($ProductId));
        return self::convertRowToObject($rows);
    }

    private static function convertRowToObject($rows){
        if(!is_null($rows)){
            $comments = [];
            foreach ($rows as $row){
                if(!is_null($row['ReplyId'])) {

                    $replyComment = new Comment($row['CommentId'],$row['Text'],($row['FirstName'] ." ".$row['LastName']),$row['Rating'],[],$row['CreationTime']);
                    $returnVal = self::putReplyInComment($comments,$replyComment,$row['ReplyId']);
                    $comments = $returnVal[1];
                }
                else{
                    $comments[] = new Comment($row['CommentId'],$row['Text'],($row['FirstName'] ." ".$row['LastName']),$row['Rating'],[],$row['CreationTime']);
                }
            }
            return $comments;
        }
        return NULL;
    }
    private static function putReplyInComment($comments,$commentNew,$id){
        $found = false;
        foreach ($comments as $comment){
            if($comment->id == $id){
                $found = true;
                $comment->replys[] = $commentNew;
                return array($found,$comments);
                break;
            }
        }
        foreach ($comments as $comment){
            $returnVal = self::putReplyInComment($comment->replys,$commentNew,$id);
            if($returnVal[0]){
                $found = true;
                return(array($found,$comments));
            }
        }
        return array($found,$comments);
    }
}
?>