<?php
require "Readinglist.php";

$db = new ReadingList();
$result = $db->getAllListings();

$ischanged = 1;
for($i = 0; $i < count($result[0]); $i++) {
	if (isset($result[$i]['title']) && isset($result[$i]['link'])) {

		$printout = "<li><div class='form-check'><input type='checkbox' class='form-check-input' id='item" . $result[$i]['id'];
		$printout .= "' onclick='removeReadingItem(" . $result[$i]['id'] . ")'><label class='form-check-label' for='item" .$result[$i]['id'] ."'>&nbsp;";
		$printout .= "<a target='_blank' href='" .$result[$i]['link'] ."'>" .$result[$i]['title'] ."</a></label></div><br>\n";
		echo $printout;
	}

}

?>