<?php 
header('Content-Type: text/html; charset=utf-8');//кодировка

require_once $_SERVER[DOCUMENT_ROOT].'/lib/db.php';


$list_id = $_REQUEST['list_id'];
$from_station = $_REQUEST['from_station'];
$to_station = $_REQUEST['to_station'];
$train = $_REQUEST['train'];
$start = $_REQUEST['start'];
$finish = $_REQUEST['finish'];
$list = $_REQUEST['list'];
$min_cost = $_REQUEST['min_cost'];

$db = new db();
$db->connect();

$select_fr_st = $db->query("select Station_ID from Station where Station='{$from_station}'");
$from_station_ID = $db->get_assoc($select_fr_st)['Station_ID'];

$select_to_st = $db->query("select Station_ID from Station where Station='{$to_station}'");
$to_station_ID = $db->get_assoc($select_to_st)['Station_ID'];

$select_train = $db->query("select Train_ID from Train where NameOfTrain='{$train}'");
$train_ID = $db->get_assoc($select_train)['Train_ID'];



$update = $db->query("UPDATE List SET FromStation_ID = '$from_station_ID', ToStation_ID = '$to_station_ID', Train_ID = '$train_ID', Start = '$start', Finish = '$finish', List = '$list', minCost = '$min_cost' WHERE List_ID ={$list_id}");

header('Location:'.$_SERVER['HTTP_REFERER']);
?>