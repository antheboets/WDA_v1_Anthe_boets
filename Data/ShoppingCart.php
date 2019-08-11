<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");
include_once($path."Data/ShoppingCartItem.php");
    class ShoppingCart{
        public $items;
        public $total;

        public function __construct($items)
        {
            $this->items = $items;
            $this->total = $this->countTotal();
        }


    }


?>