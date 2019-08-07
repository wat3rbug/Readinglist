<?php
require "Category.php";
$category = $_POST['category'];	
$db = new Category();
$db->addCategory($category);
?>
