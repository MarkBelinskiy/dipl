<?php 
header('Content-Type: text/html; charset=utf-8');//кодировка

require_once $_SERVER[DOCUMENT_ROOT].'/lib/db.php';


$way_id = $_REQUEST['way_id'];
$list_id = $_REQUEST['list_id'];
$station = $_REQUEST['station'];
$time_of_arrival = $_REQUEST['time_of_arrival'];
$time_of_departure = $_REQUEST['time_of_departure'];
$day_way = $_REQUEST['day_way'];



$db = new db();
$db->connect();


$select_station = $db->query("select Station_ID from Station where Station='{$station}'");
$station_ID = $db->get_assoc($select_station)['Station_ID'];


$update = $db->query("UPDATE Way SET  List_ID = '$list_id', Station_ID = '$station_ID', TimeOfArrival = '$time_of_arrival', TimeOfDeparture = '$time_of_departure', DayOfWay = '$day_way' WHERE Way_ID ={$way_id};");
header('Location:'.$_SERVER['HTTP_REFERER']);
?>