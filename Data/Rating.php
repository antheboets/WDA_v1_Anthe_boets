<?php
class Rating{
    public $id;
    public $rating;
    public $userId;

    public function __construct($id, $rating, $userId)
    {
        $this->id = $id;
        $this->rating = $rating;
        $this->userId = $userId;
    }
}

?>