<?php 
header('Content-Type: text/html; charset=utf-8');//кодировка

require_once $_SERVER[DOCUMENT_ROOT].'/lib/db.php';


$train_id = $_REQUEST['train_id'];
$n_train = $_REQUEST['n_train'];

$type_train = array(
	'скорый пассажирский (круглогодичного обращения)',
	'скоростной',
	'ускоренный',
	'скорый пассажирский (сезонного обращения)',
	'пассажирский летний',
	'пассажирский разового назначения',
	'разового назначения летний',
	'местный',
	'ускоренный в дальнем и местном сообщении повышенной комфортности',
	'ускоренный в дальнем и местном сообщении без предоставления дополнительных услуг',
	'грузопассажирский',
	'пригородный'
	)[$_REQUEST['type_train']];


$name_train = $_REQUEST['name_train'];

$db = new db();
$db->connect();

$update = $db->query("UPDATE Train SET N_Train='{$n_train}', TypeOfTrain = '{$type_train}', NameOfTrain = '{$name_train}' WHERE Train_ID={$train_id}");

header('Location:'.$_SERVER['HTTP_REFERER']);
?>