<?php 
header('Content-Type: text/html; charset=utf-8');//кодировка

require_once $_SERVER[DOCUMENT_ROOT].'/lib/db.php';
$wagon_cat = $_REQUEST['wagon_cat'];
$wagon_id = $_REQUEST['wagon_id'];

$db = new db();
$db->connect();

$update = $db->query("UPDATE WagonCategory SET WagonCategory='{$wagon_cat}' WHERE WagonCategory_ID={$wagon_id}");

header('Location:'.$_SERVER['HTTP_REFERER']);
?>