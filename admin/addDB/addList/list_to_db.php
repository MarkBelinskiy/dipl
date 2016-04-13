<?php 
header('Content-Type: text/html; charset=utf-8');//кодировка

require_once $_SERVER[DOCUMENT_ROOT].'/lib/db.php';


$from_station = $_REQUEST['from_station'];
$to_station = $_REQUEST['to_station'];
$train = $_REQUEST['train'];
$start = $_REQUEST['start'];
$finish = $_REQUEST['finish'];
$list = $_REQUEST['list'];
$min_cost = $_REQUEST['min_cost'];

$db = new db();
$db->connect();

$select = $db->query("select max(List_ID) from List");
$last_id = $db->get_assoc($select);
$last_id = $last_id['max(List_ID)'];

$select_fr_st = $db->query("select Station_ID from Station where Station='{$from_station}'");
$from_station_ID = $db->get_assoc($select_fr_st)['Station_ID'];

$select_to_st = $db->query("select Station_ID from Station where Station='{$to_station}'");
$to_station_ID = $db->get_assoc($select_to_st)['Station_ID'];

$select_train = $db->query("select Train_ID from Train where N_Train='{$train}'");
$train_ID = $db->get_assoc($select_train)['Train_ID'];

$start = explode("-", substr($start, 5));
list($start[0], $start[1]) = array($start[1], $start[0]);
$start = implode(".", $start);

$finish = explode("-", substr($finish, 5));
list($finish[0], $finish[1]) = array($finish[1], $finish[0]);
$finish = implode(".", $finish);

#print_r($last_id."<br>".$from_station_ID."<br>".$to_station_ID."<br>".$train_ID."<br>".$start."<br>".$finish."<br>".$list);


$incert = $db->query("INSERT INTO List (List_ID, FromStation_ID, ToStation_ID, Train_ID, Start, Finish, List, minCost) 
	VALUES ('$last_id'+1, '$from_station_ID', '$to_station_ID', '$train_ID', '$start', '$finish', '$list', '$min_cost')
	ON DUPLICATE KEY UPDATE List_ID = '$last_id', FromStation_ID = '$from_station_ID', ToStation_ID = '$to_station_ID', Train_ID = '$train_ID', Start = '$start', Finish = '$finish', List = '$list', minCost = '$min_cost';
	");

header('Location:'.$_SERVER['HTTP_REFERER']);
	?>