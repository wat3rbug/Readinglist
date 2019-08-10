<?php
require "Category.php";
$db = new Category();
$result_raw = $db->getAllCategories();

foreach ($result_raw as $result) {
	$printout = "<p><button type='button' class='btn btn-outline-danger' onclick='removeCategory(" . $result['id'] .");' id='";
	$printout .= $result['id'] . "'><span class='glyphicon glyphicon-remove'/></button>&nbsp;";
	$printout .= $result['category'] ."</p>\n";
	echo $printout;
}
?>