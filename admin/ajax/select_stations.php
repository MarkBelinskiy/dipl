<?php 
header('Content-Type: text/html; charset=utf-8');//кодировка

require_once $_SERVER[DOCUMENT_ROOT].'/lib/db.php';


$db = new db();
$db->connect();

$head = <<<HTML
<table  width="65%" class="select_table">
	<tr>
		<th >ID Станции</th>
		<th >Станция</th>
		<th >Регион</th>
		<th >Широта</th>
		<th >Долгота</th>
	</tr>
		
HTML;

$foot = <<<HTML
	</table> <br><br>
HTML;

$select = $db->query("select * from Station");
print_r($head);
while($row = $db->get_assoc($select)){

	
	echo "
	<tr >
		<td >".$row['Station_ID']."</td>
		<td >".$row['Station']."</td>
		<td >".$row['Region']."</td>
		<td >".$row['lat']."</td>
		<td >".$row['lng']."</td>
	</tr>";

}
print_r($foot);
	?>