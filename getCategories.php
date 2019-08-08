<?php
require "Category.php";
$db = new Category();
$result = $db->getAllCategories();
for ($i = 0; $i < count($result[0]); $i++) {
	if (isset($result[$i]['category'])) {
		$printout = "<p><button type='button' class='btn btn-outline-danger' onclick='removeCategory(" . $result[$i]['id'] .");' id='" . $result[$i]['id'] . "'><span class='glyphicon glyphicon-remove'/></button>&nbsp;";
		$printout .= $result[$i]['category'] ."</p>\n";
		echo $printout;
	}
}
?>