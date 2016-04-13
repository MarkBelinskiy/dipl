<?php 
require_once $_SERVER[DOCUMENT_ROOT].'/lib/db.php';
$db = new db();
$db->connect();
$select_id = $db->query("select max(Train_ID) from Train");
$last_id = $db->get_assoc($select_id);
$last_id = $last_id['max(Train_ID)'];

$train_id = $_REQUEST["train_id"];

if ($train_id < 1 || $train_id > $last_id) {
	die('<p class="train_form">Введите корректный id категории вагона</p>');
}

$select = $db->query("select * from Train where Train_ID = {$train_id}");
$select_ass =  $db->get_assoc($select);
$n_train = $select_ass['N_Train'];
$type_train = $select_ass['TypeOfTrain'];
$name_train = $select_ass['NameOfTrain'];

?>


<form class="train_form" action="updateDB/updateTrain/train_to_db.php" method="POST">

	<input type="hidden" name="train_id" value="<?php echo $train_id ?>">

	<p>Введите номер поезда:</p>
	<input type="text" name="n_train" value="<?php echo $n_train ?>"><br><br>

	<p>Введите тип поезда:</p>
	<select  name="type_train">
		<option 
		<?php  echo ($type_train == "скорый пассажирский (круглогодичного обращения)")?"selected":"" ?>
		 value="0">скорый пассажирский (круглогодичного обращения)</option>
		
		<option 
		<?php  echo ($type_train == "скоростной")?"selected":"" ?>
		 value="1">скоростной</option>
		
		<option 
		<?php  echo ($type_train == "ускоренный")?"selected":"" ?>
		 value="2">ускоренный</option>
		
		<option 
		<?php  echo ($type_train == "скорый пассажирский (сезонного обращения)")?"selected":"" ?>
		 value="3">скорый пассажирский (сезонного обращения)</option>
		
		<option 
		<?php  echo ($type_train == "пассажирский летний")?"selected":"" ?>
		 value="4">пассажирский летний</option>
		
		<option 
		<?php  echo ($type_train == "пассажирский разового назначения")?"selected":"" ?>
		 value="5">пассажирский разового назначения</option>
		
		<option 
		<?php  echo ($type_train == "разового назначения летний")?"selected":"" ?>
		 value="6">разового назначения летний</option>
		
		<option 
		<?php  echo ($type_train == "местный")?"selected":"" ?>
		 value="7">местный</option>
		
		<option 
		<?php  echo ($type_train == "ускоренный в дальнем и местном сообщении повышенной комфортности")?"selected":"" ?>
		 value="8">ускоренный в дальнем и местном сообщении повышенной комфортности</option>
		
		<option 
		<?php  echo ($type_train == "ускоренный в дальнем и местном сообщении без предоставления дополнительных услуг")?"selected":"" ?>
		 value="9">ускоренный в дальнем и местном сообщении без предоставления дополнительных услуг</option>
		
		<option 
		<?php  echo ($type_train == "грузопассажирский")?"selected":"" ?>
		 value="10">грузопассажирский</option>
		
		<option 
		<?php  echo ($type_train == "пригородный")?"selected":"" ?>
		 value="11">пригородный</option>
	</select><br><br>

	<p>Введите название поезда:</p>
	<input type="text" name="name_train" value="<?php echo $name_train ?>" ><br><br>

	<input type="submit" value="Редактировать">
</form>