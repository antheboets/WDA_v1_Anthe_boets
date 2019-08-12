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


        public function countTotal(){
            $total = 0;

            foreach ($this->items as $item){
                $total += $item->amount * $item->product->price;
            }
            return $total;
        }
    }


?>