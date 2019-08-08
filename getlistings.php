<?php
require "Readinglist.php";

$db = new ReadingList();
$result = $db->getAllListings();

$first = true;
$category = NULL;
$printout;

for($i = 0; $i < count($result[0]); $i++) {
	if (isset($result[$i]['title']) && isset($result[$i]['link'])) {
		//echo "local: " . $category . "\tdb: " . $result[$i]['category'] . "\n";
		if ($first == true) {
			$printout .= getPanelTop($result[$i]['category']);
			$first = false;
			$category = $result[$i]['category'];
		}
		if ($category != $result[$i]['category']) {
			$printout = "</ul>\n</div>\n</div>\n<br/>";
			$printout .= getPanelTop($result[$i]['category']);
			$category = $result[$i]['category'];
		}
		
		$printout .= "<li class='list-group-item'><div class='form-check'><button type='button' class='btn btn-outline-danger' id='item";
		$printout .= $result[$i]['id'] . "' onclick='removeReadingItem(" . $result[$i]['id'];
		$printout .= ")'><span class='glyphicon glyphicon-remove'/></button>&nbsp;";
		$printout .= "<a target='_blank' href='" .$result[$i]['link'] ."'>" .$result[$i]['title'];
		$printout .= "</a></div></li>\n";
		if ($result[$i] == end($result)) {
			$printout .= "</ul></div></div>\n";
		}
		echo $printout;
		$printout = NULL;
	}

}

function getPanelTop($category) {
	
	$printout = "<div class='card'>\n<div class='card-header'>". $category;
	$printout .= "</div>\n<div class='card-body'>\n<ul class='list-group list-group-flush'>\n";
	return $printout;
}

?>