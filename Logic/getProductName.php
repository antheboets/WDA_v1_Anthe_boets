<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");
include_once($path."Database/ProductDAO.php");
//https://www.codeofaninja.com/2017/02/create-simple-rest-api-in-php.html
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"));
class NameDto{
    public $id;
    public $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}
$dataList = [];
$rows = ProductDAO::getNameForSearch($data->name);
foreach ($rows as $row){
    $dataList[] = new NameDto($row['ProductId'], $row['Name']);
}
http_response_code(200);
echo json_encode($dataList);
?>