<?php
require "Category.php";
$db = new Category();
$dbResult = $db->getAllCategories();

$i = 1;
foreach ($dbResult as $result) {
	if (isset($result['category'])) {
		if ($i == 1) {
			$printout = "<option selected value='" . $result['id'] . "'>" . $result['category'];
		} else {
			$printout = "<option value='" .$result['id'] ."'>" . $result['category'];		
		}
		$printout .= "</option>\n";
		echo $printout;
	}
	$i++;
}
?>
