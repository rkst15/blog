<?php
require_once "classes/Category.php";
$category = new Category;
session_start();
//create category
if (isset($_POST['createc'])) {
    $categoryname = $_POST['categoryname'];
    $category->createCategory($categoryname);
}

//edit category
elseif(isset($_POST['editc'])){
    $newcategory = $_POST['newcategory'];
    $id = $_POST['id'];
    $category->editCategory($newcategory,$id);
}

//delete admin
elseif ($_GET['action_c'] == 'delete') {
    $id = $_GET['id'];
    $category->deleteCategory($id);
}
