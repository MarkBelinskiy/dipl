<?php 
header('Content-Type: text/html; charset=utf-8');//кодировка

require_once $_SERVER[DOCUMENT_ROOT].'/lib/db.php';


$db = new db();
$db->connect();

$head = <<<HTML
<div class="add_train"></div>
<div class="update_train"></div>

	<table class="select_table">
		<tr>
			<th >ID поезда</th>
			<th >Номер поезда</th>
			<th >Тип поезда</th>
			<th >Название поезда</th>
		</tr>
		
HTML;

$foot = <<<HTML
	</table> <br><br>
  <div class="select_list_by_id"></div>
HTML;

$select = $db->query("select * from Train");
print_r($head);
while($row = $db->get_assoc($select)){

	
	echo "
	<tr onclick=\"select_list_by_id(".$row['Train_ID'].");\">
		<td >".$row['Train_ID']."</td>
		<td >".$row['N_Train']."</td>
		<td >".$row['TypeOfTrain']."</td>
		<td >".$row['NameOfTrain']."</td>
	</tr>";

}
print_r($foot);
	?>