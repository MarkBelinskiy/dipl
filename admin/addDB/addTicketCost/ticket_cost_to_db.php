<?php 
header('Content-Type: text/html; charset=utf-8');//кодировка

require_once $_SERVER[DOCUMENT_ROOT].'/lib/db.php';

$id_way = $_REQUEST['id_way'];
$wagon_category = $_REQUEST['wagon_category'];
$ticket_cost = $_REQUEST['ticket_cost'];


$db = new db();
$db->connect();

$select = $db->query("select max(TicketCost_ID) from TicketCost");
$last_id = $db->get_assoc($select);
$last_id = $last_id['max(TicketCost_ID)'];

$incert = $db->query("INSERT INTO TicketCost (TicketCost_ID, Way_ID, WagonCategory_ID, TicketCost) 
	VALUES ('$last_id'+1, '$id_way', '$wagon_category', '$ticket_cost')
	ON DUPLICATE KEY UPDATE TicketCost_ID = '$last_id', Way_ID = '$id_way', WagonCategory_ID = '$wagon_category', TicketCost = '$ticket_cost';
	");
header('Location:'.$_SERVER['HTTP_REFERER']);
?>