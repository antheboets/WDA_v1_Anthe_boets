<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/eShop/Logic/lib.php");
session_start();
include_once($path."database/UserDAO.php");
include_once($path."database/ProductDAO.php");
include($path."database/CategoryDAO.php");
if($_SERVER["REQUEST_METHOD"] == 'POST') {
    if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['image']) && isset($_POST['price']) && isset($_POST['price'])){
        if(!empty($_POST['name'])&& !empty($_POST['description']) && !empty($_POST['image'])&& !empty($_POST['price'])){
            $errors = [];
            if(ProductDAO::IsNameTaken($_POST['name'])){
                $errors[] = "Name taken";
            }
            $category = new Category($_POST['category'],"");
            if(CategoryDAO::IsCategory($category)){
                $errors[] = "Category does not exits";
            }
            if(!$_SESSION['user']->$admin) {
                $errors[] = "Not authenticated";
            }
            if(empty($errors)){
                $product = new Product(0, $_POST['name'], $_POST['description'] ,$_POST['image'], $_POST['price'],$category,NULL,NULL);
                if(ProductDAO::create($product)){

                }
            }
            else{

            }
        }
    }
}
?>