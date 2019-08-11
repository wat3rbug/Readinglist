<?php
require "Readinglist.php";

$db = new ReadingList();
$result_raw = $db->getAllListings();

$first = true;
$category = NULL;

foreach($result_raw as $result) {
	$printout = " ";
	$row_cat = str_replace(" ", "_", $result['category']);
	if ($first == true) {
		$printout = getPanelTop($result['category']);
		$first = false;
		$category = $row_cat;
	}
	if ($category != $row_cat) {
		$printout = "\n\t\t</ul>\n\t</div>\n</div>\n<br/>\n";
		$printout .= getPanelTop($result['category']);
		$category = $row_cat;
	}
	
	$printout .= "\t\t\t<li class='list-group-item'><div class='form-check'><button type='button' class='btn btn-outline-danger' id='item";
	$printout .= $result['id'] . "' onclick='removeReadingItem(" . $result['id'];
	$printout .= ")'><span class='glyphicon glyphicon-remove'></span></button>&nbsp;";
	$printout .= "<a target='_blank' href='" .$result['link'] ."'>" .$result['title'];
	$printout .= "</a></div></li>\n";
	if ($result == end($result_raw)) {
		$printout .= "\t\t</ul>\n\t</div>\n</div>\n";
	}
	echo $printout;
	$printout = NULL;
}

function getPanelTop($category) {
	$row_cat = str_replace(" ", "_", $category);
	$printout = "<div class='card'>\n\t<div class='card-header'><a name='". $row_cat . "'>" .$category;
	$printout .= "</a></div>\n\t<div class='card-body'>\n\t\t<ul class='list-group list-group-flush'>\n";
	return $printout;
}
?>