<?php
require "Readinglist.php";

$db = new Readinglist();
$title = $_POST['title'];
$link = $_POST['link'];
$category = $_POST['category'];
$db->addListing($title, $link, $category);
?>