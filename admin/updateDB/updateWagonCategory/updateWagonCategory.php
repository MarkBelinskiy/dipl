<?php 
require_once $_SERVER[DOCUMENT_ROOT].'/lib/db.php';
$db = new db();
$db->connect();
$select_id = $db->query("select max(WagonCategory_ID) from WagonCategory");
$last_id = $db->get_assoc($select_id);
$last_id = $last_id['max(WagonCategory_ID)'];

$cat_id = $_REQUEST["cat_id"];

if ($cat_id < 1 || $cat_id > $last_id) {
	die('<p class="cat_form">Введите корректный id категории вагона</p>');
}


$select = $db->query("select * from WagonCategory where WagonCategory_ID = {$cat_id}");

$wagon_cat = $db->get_assoc($select)['WagonCategory'];


 ?>

	<form class="cat_form" action="updateDB/updateWagonCategory/cat_to_db.php" method="POST">
		<p>Введите правки в категории вагона, для ее редактирования:</p>
		<input type="text" name="wagon_cat" value="<?php echo $wagon_cat ?>">
		<input type="hidden" name="wagon_id" value="<?php echo $cat_id ?>">
		<input type="submit" value="Редактировать БД">
	</form>
