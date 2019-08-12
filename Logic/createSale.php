<?php

include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == 'POST') {

    if(isset($_POST['diffrentDelivertAddress']) && isset($_POST['paymentMethod'])){
        if(!empty($_POST['diffrentDelivertAddress'])) {

            /*
            public $id;
            public $user;
            public $billingAddress;
            public $deliveryAddress;
            public $deliveryMethod;
            public $paymentMethod;
            public $saleItems;
            */

        }
    }
}





?>