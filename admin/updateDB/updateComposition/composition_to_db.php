<?php 
header('Content-Type: text/html; charset=utf-8');//кодировка

require_once $_SERVER[DOCUMENT_ROOT].'/lib/db.php';

print_r($_REQUEST);

$wagon_category = $_REQUEST['wagon_category'];
$train = $_REQUEST['train'];

$db = new db();
$db->connect();

$select = $db->query("select max(Composition_ID) from Composition");
$last_id = $db->get_assoc($select);
$last_id = $last_id['max(Composition_ID)'];

$select_train = $db->query("select Train_ID from Train where N_Train='{$train}'");
$train_ID = $db->get_assoc($select_train)['Train_ID'];


$incert = $db->query("INSERT INTO Composition (Composition_ID, WagonCategory_ID, Train_ID) 
	VALUES ('$last_id'+1, '$wagon_category', '$train_ID')
	ON DUPLICATE KEY UPDATE Composition_ID = '$last_id', WagonCategory_ID = '$wagon_category', Train_ID = '$train_ID';
	");

header('Location:'.$_SERVER['HTTP_REFERER']);
	?>