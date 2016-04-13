<?php 
header('Content-Type: text/html; charset=utf-8');//кодировка

require_once $_SERVER[DOCUMENT_ROOT].'/lib/db.php';
$arr = $_REQUEST['arr'];
$arr_ex = explode(",", $arr);

$db = new db();
$db->connect();
$select = $db->query("select max(Station_ID) from Station");
$last_id = $db->get_assoc($select);
$last_id = $last_id['max(Station_ID)'];

$incert = $db->query("INSERT INTO Station (Station_ID, Station, Region, lat, lng) 
	VALUES ('$last_id'+1, '$arr_ex[2]', '$arr_ex[3]', '$arr_ex[0]', '$arr_ex[1]')
	ON DUPLICATE KEY UPDATE Station_ID = '$last_id', Station = '$arr_ex[2]', Region = '$arr_ex[3]', lat = '$arr_ex[0]', lng = '$arr_ex[1]';
	");
header('Location:'.$_SERVER['HTTP_REFERER']);

?>