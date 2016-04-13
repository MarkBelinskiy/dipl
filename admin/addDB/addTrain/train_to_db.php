<?php 
header('Content-Type: text/html; charset=utf-8');//кодировка

require_once $_SERVER[DOCUMENT_ROOT].'/lib/db.php';


$n_train = $_REQUEST['n_train'];

$type_train = array(
	'скорый пассажирский (круглогодичного обращения)',
	'скоростный',
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

$select = $db->query("select max(Train_ID) from Train");
$last_id = $db->get_assoc($select);
$last_id = $last_id['max(Train_ID)'];

$incert = $db->query("INSERT INTO Train (Train_ID, N_Train, TypeOfTrain, NameOfTrain) 
	VALUES ('$last_id'+1, '$n_train', '$type_train', '$name_train')
	ON DUPLICATE KEY UPDATE Train_ID = '$last_id', N_Train = '$n_train', TypeOfTrain = '$type_train', NameOfTrain = '$name_train';
	");
header('Location:'.$_SERVER['HTTP_REFERER']);

	?>