<?php 
header('Content-Type: text/html; charset=utf-8');//кодировка

require_once $_SERVER[DOCUMENT_ROOT].'/lib/db.php';


$db = new db();
$db->connect();

$head = <<<HTML
    <table  class="select_table">
		<tr>
			<th >ID Cостава</th>
			<th >Поезд</th>
			<th >Категория вагона</th>
		</tr>
		
HTML;

$foot = <<<HTML
	</table>
HTML;

$select = $db->query("select * from Composition order by Train_ID");
print_r($head);
while($row = $db->get_assoc($select)){
$select_wag_cat = $db->query("select WagonCategory from WagonCategory where WagonCategory_ID='{$row['WagonCategory_ID']}'");
  $wag_cat = $db->get_assoc($select_wag_cat)['WagonCategory'];


	$select_train = $db->query("select N_Train, NameOfTrain from Train where Train_ID='{$row['Train_ID']}'");
	$train_assoc = $db->get_assoc($select_train);
	$n_train = $train_assoc['N_Train'];
	$name_train = $train_assoc['NameOfTrain'];
	echo "
	<tr>
		<td >".$row['Composition_ID']."</td>
		<td >".$n_train." (". $name_train .")</td>
		<td >".$wag_cat."</td>
	</tr>";

}
print_r($foot);
	?>