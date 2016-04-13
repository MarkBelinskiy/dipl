<?php 
header('Content-Type: text/html; charset=utf-8');//кодировка

require_once $_SERVER[DOCUMENT_ROOT].'/lib/db.php';

$ticket_cost_id = $_REQUEST['ticket_cost_id'];
$way_id = $_REQUEST['way_id'];
$wagon_category_id = $_REQUEST['wagon_category_id'];
$ticket_cost = $_REQUEST['ticket_cost'];


$db = new db();
$db->connect();

$update = $db->query("UPDATE TicketCost SET Way_ID = '$way_id', WagonCategory_ID = '$wagon_category_id', TicketCost = '$ticket_cost' WHERE TicketCost_ID = '$ticket_cost_id';");
header('Location:'.$_SERVER['HTTP_REFERER']);
?>