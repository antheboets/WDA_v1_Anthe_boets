<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");
include_once($path."Data/Product.php");
    class ShoppingCartItem{
        public $product;
        public $amount;

        public function __construct($product, $amount)
        {
            $this->product = $product;
            $this->amount = $amount;
        }


    }
?>