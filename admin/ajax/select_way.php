<?php 
header('Content-Type: text/html; charset=utf-8');//кодировка

require_once $_SERVER[DOCUMENT_ROOT].'/lib/db.php';

$id_list = $_REQUEST['id_list'];
$db = new db();
$db->connect();

$head = <<<HTML
<div class="add_way"></div>
<div class="update_way"></div>

<table class="select_table">
		<tr>
			<th >ID Пути</th>
			<th >Станция</th>
      <th >Время прибытия </th>
			<th >Время cтоянки </th>
      <th >Время отправления</th>
			<th >День пути</th>
		</tr>
		
HTML;

$foot = <<<HTML
	</table><br><br>
  <div class="select_ticket_cost_by_id"></div>

HTML;

$select = $db->query("select * from Way where List_ID='{$id_list}' order by Way_ID");
print_r($head);
while($row = $db->get_assoc($select)){

	$select_station = $db->query("select Station from Station where Station_ID='{$row['Station_ID']}'");
	$station = $db->get_assoc($select_station)['Station'];

 $stop_time = ($row['TimeOfArrival'] == "00:00:00") ? 0 : date ("i", strtotime ($row['TimeOfDeparture']) - strtotime ($row['TimeOfArrival']));

	echo "
	<tr onclick=\"select_ticket_cost_by_id(".$row['Way_ID'].");\">
    <td >".$row['Way_ID']."</td>
    <td >".$station."</td>
    <td >".substr($row['TimeOfArrival'],0,5)."</td>
		<td >".$stop_time."</td>
    <td >".substr($row['TimeOfDeparture'],0,5)."</td>
		<td >".$row['DayOfWay']."</td>
	</tr>";

}
print_r($foot);
	?>