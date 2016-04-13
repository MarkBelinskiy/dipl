<?php 
header('Content-Type: text/html; charset=utf-8');//кодировка

require_once $_SERVER[DOCUMENT_ROOT].'/lib/db.php';

$id_way = $_REQUEST['id_way'];
$db = new db();
$db->connect();

$head = <<<HTML
<div class="add_ticket_cost"></div>
<div class="update_ticket_cost"></div>
<table class="select_table">
		<tr>
			<th >ID Билета</th>
      <th >ID Пути</th>
			<th >Категория вагона</th>
      <th >Стоимость билета (грн.) </th>
		</tr>
		
HTML;

$foot = <<<HTML
	</table>
<br><br>  
HTML;

$select = $db->query("select * from TicketCost where Way_ID = '{$id_way}'
  ORDER BY Way_ID");
print_r($head);
while($row = $db->get_assoc($select)){

	$select_wag_cat = $db->query("select WagonCategory from WagonCategory where WagonCategory_ID='{$row['WagonCategory_ID']}'");
	$wag_cat = $db->get_assoc($select_wag_cat)['WagonCategory'];


	echo "
	<tr>
    <td >".$row['TicketCost_ID']."</td>
		<td >".$row['Way_ID']."</td>
    <td >".$wag_cat."</td>
    <td >".$row['TicketCost']."</td>
	</tr>";

}
print_r($foot);
	?>