<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");
include_once($path."Data/SaleItem.php");
include_once($path."Data/Address.php");
include_once($path."Data/User.php");
class Sale{
    public $id;
    public $user;
    public $billingAddress;
    public $deliveryAddress;
    public $deliveryMethod;
    public $paymentMethod;
    public $saleItems;

    public function __construct($id, $user, $billingAddress, $deliveryAddress, $deliveryMethod, $paymentMethod, $saleItems)
    {
        $this->id = $id;
        $this->user = $user;
        $this->billingAddress = $billingAddress;
        $this->deliveryAddress = $deliveryAddress;
        $this->deliveryMethod = $deliveryMethod;
        $this->paymentMethod = $paymentMethod;
        $this->saleItems = $saleItems;
    }


}
?>