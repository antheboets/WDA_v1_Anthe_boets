<?php
//https://github.com/taniarascia/upload
error_reporting(0);
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");
include_once($path."database/UserDAO.php");
session_start();
header("location: ".$headerPath."index.php");
include_once($path."database/ProductDAO.php");
if($_SERVER["REQUEST_METHOD"] === 'POST') {
    if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['category']) && isset($_POST['price'])){
        if(!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['category'])&& !empty($_POST['price'])){
            header("location: ".$headerPath."UI/pages/addProduct.php");
            $errors = [];
            $extensions = ['jpg', 'jpeg', 'png'];
            $file_tmp = $_FILES['files']['tmp_name'][0];
            $file_size = $_FILES['files']['size'][0];
            $file_type = $_FILES['files']['type'][0];
            $file_ext = strtolower(end(explode('.', $_FILES['files']['name'][0])));
            if(ProductDAO::IsNameTaken($_POST['name'])){
                $errors[] = "Name taken";
            }
            $category = new Category($_POST['category'],"");
            if(!CategoryDAO::IsCategory($category)){
                $errors[] = "Category does not exits";
            }
            if(!$_SESSION['user']->admin) {
                $errors[] = "Not authenticated";
            }
            //https://stackoverflow.com/questions/14758191/how-to-use-filesfilesize
            define('MB', 1048576);
            if ($file_size > 20*MB) {
                $errors[] = 'File size exceeds limit: ' . $file_name . ' ' . $file_type;
            };
            if (!in_array($file_ext, $extensions)) {
                $errors[] = 'Extension not allowed: ' . $file_name . ' ' . $file_type;
            }

                $image = file_get_contents($file_tmp);
                $product = new Product(0, $_POST['name'], $_POST['description'] ,$image, $_POST['price'],$category,NULL,NULL,0);
                ProductDAO::create($product);

        }
    }
}
?>