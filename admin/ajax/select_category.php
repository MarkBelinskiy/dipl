<?php 
header('Content-Type: text/html; charset=utf-8');//кодировка

require_once $_SERVER[DOCUMENT_ROOT].'/lib/db.php';


$db = new db();
$db->connect();

$head = <<<HTML
<div class="update_category"></div>
<table  width="65%" class="select_table">
	<tr>
		<th >ID Категории</th>
		<th >Категория вагона</th>
	</tr>
		
HTML;

$foot = <<<HTML
	</table> <br><br>
HTML;

$select = $db->query("select * from WagonCategory");
print_r($head);
while($row = $db->get_assoc($select)){

	
	echo "
	<tr >
		<td >".$row['WagonCategory_ID']."</td>
		<td >".$row['WagonCategory']."</td>
	</tr>";

}
print_r($foot);
	?>