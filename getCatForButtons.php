<?php
require "Category.php";
$db = new Category();
$result_raw = $db->getAllUsedCategories();

foreach ($result_raw as $result) {
	$row_cat = str_replace(" ", "_", $result['category']);
	$printout = "&nbsp;<a class='btn btn-outline-info' href='#" . $row_cat . "' role='button'>" . $result['category'] ."</a>\n";
	echo $printout;

}
?>