<?php
require "Category.php";
$db = new Category();
$result_raw = $db->getAllUsedCategories();

foreach ($result_raw as $result) {
	$printout = "&nbsp;<a class='btn btn-outline-info' href='#" . $result['category'] . "' role='button'>" . $result['category'] ."</a>\n";
	echo $printout;

}
?>