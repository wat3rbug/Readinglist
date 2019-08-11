<?php
require "Category.php";
$db = new Category();

$id = $_POST['catId'];
$category = $_POST['category'];

$db->editCategory($id, $category);
?>