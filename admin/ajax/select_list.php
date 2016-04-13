<?php 
header('Content-Type: text/html; charset=utf-8');//кодировка

require_once $_SERVER[DOCUMENT_ROOT].'/lib/db.php';

$id_train = $_REQUEST['id_train'];

$db = new db();
$db->connect();

$head = <<<HTML
<div class="update_list"></div>
<div class="add_list"></div>

	<table  class="select_table">
		<tr>
			<th >ID Расписания</th>
			<th >Откуда</th>
			<th >Куда</th>
			<th >Поезд</th>
			<th >Старт</th>
			<th >Финиш</th>
			<th >Расписание</th>
			<th >Минимальная цена</th>
		</tr>
		
HTML;

$foot = <<<HTML
	</table><br><br>
  <div class="select_way_by_id"></div>
HTML;

$select = $db->query("select * from List where Train_ID = {$id_train}");
print_r($head);
while($row = $db->get_assoc($select)){

	$select_fr_st = $db->query("select Station from Station where Station_ID='{$row['FromStation_ID']}'");
	$from_station = $db->get_assoc($select_fr_st)['Station'];

	$select_to_st = $db->query("select Station from Station where Station_ID='{$row['ToStation_ID']}'");
	$to_station = $db->get_assoc($select_to_st)['Station'];

	$select_train = $db->query("select N_Train, NameOfTrain from Train where Train_ID='{$row['Train_ID']}'");
	$train_assoc = $db->get_assoc($select_train);
	$n_train = $train_assoc['N_Train'];
	$name_train = $train_assoc['NameOfTrain'];

	switch ($row['List']) {
		case '0':
		$list = "Каждый день";
		break;

		case '1':
		$list = "По четным";
		break;

		case '2':
		$list = "По нечетным";
		break;

	}
	echo "
	<tr onclick=\"select_way_by_id(".$row['List_ID'].");\">
		<td >".$row['List_ID']."</td>
		<td >".$from_station."</td>
		<td >".$to_station."</td>
		<td >".$n_train." (". $name_train .")</td>
		<td >".$row['Start']."</td>
		<td >".$row['Finish']."</td>
		<td >".$list."</td>
		<td >".$row['minCost']."</td>
	</tr>";

}
print_r($foot);
	?>