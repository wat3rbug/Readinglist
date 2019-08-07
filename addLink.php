<?php
require "Readinglist.php";

$db = new Readinglist();
$title = $_POST['title'];
$link = $_POST['link'];
$db->addListing($title, $link);
?>