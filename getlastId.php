<?php
require "Readinglist.php";
$db = new ReadingList();
$id = $db->getIdForLastInsert();
return $id['id'];
?>