<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");
include_once($path."Database/UserDAO.php");
include_once($path."Database/ProductDAO.php");
include_once($path."Database/ShoppingCartDAO.php");
session_start();
//https://www.codeofaninja.com/2017/02/create-simple-rest-api-in-php.html
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"));
$errors = [];

if(empty(UserDAO::getById($_SESSION['user']->id))){
    $errors[] = "userId doest exist";

}
if(empty(ProductDAO::getById($data->productId))){
    $errors[] = "productId doest exist";
}
if(empty($errors)){
    if(ShoppingCartDAO::isItem($_SESSION['user']->id,$data->productId)){
        ShoppingCartDAO::updateItem($data->productId,$data->amount,$_SESSION['user']->id);
    }
    else{
        ShoppingCartDAO::createItem($data->productId,$data->amount,$_SESSION['user']->id);
    }
    http_response_code(200);
}
else{
    http_response_code(400);
    echo json_encode($errors);
}
?>