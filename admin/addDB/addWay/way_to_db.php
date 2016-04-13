<?php 
header('Content-Type: text/html; charset=utf-8');//кодировка

require_once $_SERVER[DOCUMENT_ROOT].'/lib/db.php';


$list_name = $_REQUEST['list_name'];
$station = $_REQUEST['station'];
$time_of_arrival = $_REQUEST['time_of_arrival'];
$time_of_departure = $_REQUEST['time_of_departure'];
$day_way = $_REQUEST['day_way'];

$db = new db();
$db->connect();

$select = $db->query("select max(Way_ID) from Way");
$last_id = $db->get_assoc($select);
$last_id = $last_id['max(Way_ID)'];

$select_list = $db->query("select List_ID from List where List_ID='{$list_name}'");
$list_ID = $db->get_assoc($select_list)['List_ID'];

$select_station = $db->query("select Station_ID from Station where Station='{$station}'");
$station_ID = $db->get_assoc($select_station)['Station_ID'];


$incert = $db->query("INSERT INTO Way (Way_ID, List_ID, Station_ID, TimeOfArrival, TimeOfDeparture, DayOfWay) 
	VALUES ('$last_id'+1, '$list_ID', '$station_ID', '$time_of_arrival', '$time_of_departure', '$day_way')
	ON DUPLICATE KEY UPDATE Way_ID = '$last_id', List_ID = '$list_ID', Station_ID = '$station_ID', TimeOfArrival = '$time_of_arrival', TimeOfDeparture = '$time_of_departure', DayOfWay = '$day_way';
	");

header('Location:'.$_SERVER['HTTP_REFERER']);
	?>