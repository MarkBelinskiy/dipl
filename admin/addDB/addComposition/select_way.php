<?php 
header('Content-Type: text/html; charset=utf-8');//кодировка

require_once $_SERVER[DOCUMENT_ROOT].'/lib/db.php';


$db = new db();
$db->connect();

$head = <<<HTML
<style>
@import url(http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100);

.select_table {
  font-family: "Roboto", helvetica, arial, sans-serif;
  font-size: 16px;
  font-weight: 400;
  text-rendering: optimizeLegibility;
}

div.table-title {
   display: block;
  margin: auto;
  width: 100%;
}



/*** Table Styles **/

table {
    margin: auto; /* Выравниваем таблицу по центру окна  */
   }



.select_table .select_table .table-fill {
  background: white;
  border-radius:3px;
  border-collapse: collapse;
  height: 20px;
  margin: auto;
  width: 100%;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  animation: float 5s infinite;
}
 
.select_table th {
  color:#fff;
  background:#1abc9c;
  border-bottom:2px solid #16a085;
  border-right: 2px solid #16a085;

  font-size:20px;
  font-weight: 200;
  padding:10px;
  text-align: center; 
  text-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
  vertical-align:middle;
}

.select_table th:first-child {
  border-top-left-radius:3px;
}
 
.select_table th:last-child {
  border-top-right-radius:3px;
  border-right:none;
}
  
.select_table tr {
  border-top: 1px solid #C1C3D1;
  border-bottom-: 1px solid #C1C3D1;
  color:#666B85;
  font-size:16px;
  font-weight:normal;
  text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
}
 
.select_table tr:hover td {
  background:#1BBC9B;
  color:#FFFFFF;
  border-top: 1px solid #22262e;
  border-bottom: 1px solid #22262e;
}
 
.select_table tr:first-child {
  border-top:none;
}

.select_table tr:last-child {
  border-bottom:none;
}
 
.select_table tr:nth-child(odd) td {
  background:#EBEBEB;
}
 
.select_table tr:nth-child(odd):hover td {
  background:#1BBC9B;
}

.select_table tr:last-child td:first-child {
  border-bottom-left-radius:3px;
}
 
.select_table tr:last-child td:last-child {
  border-bottom-right-radius:3px;
}
 
.select_table td {
  background:#FFFFFF;
  padding:5px;
  text-align: center; 
  vertical-align:middle;
  font-weight:300;
  font-size:16px;
  text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
  border-right: 1px solid #C1C3D1;
}

.select_table td:last-child {
  border-right: 0px;
}

.select_table th.text-left {
  text-align: left;
}

.select_table th.text-center {
  text-align: center;
}

.select_table th.text-right {
  text-align: right;
}

.select_table td.text-left {
  text-align: left;
}

.select_table td.text-center {
  text-align: center;
}

.select_table .select_table td.text-right {
  text-align: right;
}
</style>
	<table  width="65%" class="select_table">
		<tr>
			<th >ID Пути</th>
      <th >ID Расписания</th>
			<th >Станция</th>
      <th >Время прибытия </th>
			<th >Время cтоянки </th>
      <th >Время отправления</th>
			<th >День пути</th>
		</tr>
		
HTML;

$foot = <<<HTML
	</table>
HTML;

$select = $db->query("select * from Way");
print_r($head);
while($row = $db->get_assoc($select)){

	$select_station = $db->query("select Station from Station where Station_ID='{$row['Station_ID']}'");
	$station = $db->get_assoc($select_station)['Station'];

 $stop_time = ($row['TimeOfArrival'] == "00:00:00") ? 0 : date ("i", strtotime ($row['TimeOfArrival'])-strtotime ($row['TimeOfDeparture']));

	echo "
	<tr>
    <td >".$row['Way_ID']."</td>
		<td >".$row['List_ID']."</td>
    <td >".$station."</td>
    <td >".$row['TimeOfArrival']."</td>
		<td >".$stop_time."</td>
    <td >".$row['TimeOfDeparture']."</td>
		<td >".$row['DayOfWay']."</td>
	</tr>";

}
print_r($foot);
	?>