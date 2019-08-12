<?php
class Category{
    public $id;
    public $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function  drawOption(){
        echo "<option value='".$this->id."'>".$this->name."</option>";
    }
}
?>