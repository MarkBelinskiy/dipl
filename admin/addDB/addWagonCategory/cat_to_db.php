<?php 
header('Content-Type: text/html; charset=utf-8');//кодировка

require_once $_SERVER[DOCUMENT_ROOT].'/lib/db.php';
$wagon_cat = $_REQUEST['wagon_cat'];

$db = new db();
$db->connect();
$select = $db->query("select max(WagonCategory_ID) from WagonCategory");
$last_id = $db->get_assoc($select);
$last_id = $last_id['max(WagonCategory_ID)'];

$incert = $db->query("INSERT INTO WagonCategory (WagonCategory_ID, WagonCategory) 
	VALUES ('$last_id'+1, '$wagon_cat')
	ON DUPLICATE KEY UPDATE WagonCategory_ID = '$last_id', WagonCategory = '$wagon_cat';
	");
header('Location:'.$_SERVER['HTTP_REFERER']);

?>