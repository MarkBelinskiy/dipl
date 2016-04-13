<?php
require_once $_SERVER[DOCUMENT_ROOT].'/lib/db.php';

file_exists(__DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'Handler.php') ? require_once __DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'Handler.php' : die('There is no such a file: Handler.php');
file_exists(__DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'Config.php') ? require_once __DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'Config.php' : die('There is no such a file: Config.php');

use AjaxLiveSearch\core\Config;
use AjaxLiveSearch\core\Handler;

if (session_id() == '') {
	session_start();
}

Handler::getJavascriptAntiBot();
$token = Handler::getToken();
$time = time();
$maxInputLength = Config::getConfig('maxInputLength');


$db = new db();
$db->connect();
$select_id = $db->query("select max(List_ID) from List");
$last_id = $db->get_assoc($select_id);
$last_id = $last_id['max(List_ID)'];

$list_id = $_REQUEST["list_id"];

if ($list_id < 1 || $list_id > $last_id) {
	die('<p class="list_form">Введите корректный id категории вагона</p>');
}

$select = $db->query("select * from List where List_ID = {$list_id}");
$select_ass = $db->get_assoc($select);
$from_station = $select_ass['FromStation_ID'];
$to_station = $select_ass['ToStation_ID'];
$train_id = $select_ass['Train_ID'];
$start = $select_ass['Start'];
$finish = $select_ass['Finish'];
$list = $select_ass['List'];
$min_cost = $select_ass['minCost'];

$select_fr_st = $db->query("select Station from Station where Station_ID='{$from_station}'");
$from_station = $db->get_assoc($select_fr_st)['Station'];

$select_to_st = $db->query("select Station from Station where Station_ID='{$to_station}'");
$to_station = $db->get_assoc($select_to_st)['Station'];

$select_train = $db->query("select NameOfTrain from Train where Train_ID='{$train_id}'");
$train = $db->get_assoc($select_train)['NameOfTrain'];
?>

<form class="list_form" action="updateDB/updateList/list_to_db.php">
	<input type="hidden" name="list_id" value="<?php echo $list_id ?>">

	<p>Введите станцию отправления:</p>
	<input  type="text" value="<?php echo $from_station ?>" name="from_station" class='mySearch_from_station' id="ls_query_from_station"  placeholder="Начните печатать ..."/>

	<input hidden type="text" class="from_station" name="from_station" /><br>

	<p>Введите станцию прибытия:</p>
	<input type="text" value="<?php echo $to_station ?>" name="to_station" class='mySearch_to_station' id="ls_query_to_station" placeholder="Начните печатать ...">
	<input hidden type="text" class="to_station" name="to_station" /><br>


	<p>Введите название поезда:</p>
	<input  type="text" value="<?php echo $train ?>" name="train" class='mySearch_train' id="ls_query_train" placeholder="Начните печатать ...">
	<input hidden type="text" class="train" name="train" /><br>


	<p>Введите дату отправления</p>
	<input type="text" value="<?php echo $start ?>" name="start"  /><br><br>

	<p>Введите дату прибытия</p>
	<input type="text" value="<?php echo $finish ?>" name="finish" /><br><br>

	<p>Введите минимальную цену билета</p>
	<input type="text" value="<?php echo $min_cost ?>" name="min_cost" /><br><br>

	<p>Введите расписание поезда</p>
	<select name="list">
		<option <?php  echo ($list == 0)?"selected":"" ?> value="0">Каждый день</option>
		<option <?php  echo ($list == 1)?"selected":"" ?> value="1">По нечетным</option>
		<option <?php  echo ($list == 2)?"selected":"" ?> value="2">По четным</option>
	</select><br><br>

	<input type="submit" value="Добавить в БД">
</form><br>


<script>
	jQuery(document).ready(function(){
		jQuery(".mySearch_from_station").ajaxlivesearch({
			loaded_at: <?php echo $time; ?>,
			token: <?php echo "'" . $token . "'"; ?>,
			maxInput: <?php echo $maxInputLength; ?>,
			onResultClick: function(e, data) {
			// get the index 1 (second column) value
			var selectedOne = jQuery(data.selected).find('td').eq('1').text();

			// set the input value
			jQuery('.mySearch_from_station').val(selectedOne);

			// hide the result
			jQuery(".mySearch_from_station").trigger('ajaxlivesearch:hide_result');

		},
		onResultEnter: function(e, data) {
			// get the index 1 (second column) value
			var selectedOne = jQuery(data.selected).find('td').eq('1').text();

			// set the input value
			jQuery('.mySearch_from_station').val(selectedOne);

			// hide the result
			jQuery(".mySearch_from_station").trigger('ajaxlivesearch:hide_result');
			
			
		},


		onAjaxComplete: function(e, data) {
		}
	});

		jQuery(".mySearch_to_station").ajaxlivesearch({
			loaded_at: <?php echo $time; ?>,
			token: <?php echo "'" . $token . "'"; ?>,
			maxInput: <?php echo $maxInputLength; ?>,
			onResultClick: function(e, data) {
			// get the index 1 (second column) value
			var selectedOne = jQuery(data.selected).find('td').eq('1').text();

			// set the input value
			jQuery('.mySearch_to_station').val(selectedOne);

			// hide the result
			jQuery(".mySearch_to_station").trigger('ajaxlivesearch:hide_result');

		},
		onResultEnter: function(e, data) {
			// get the index 1 (second column) value
			var selectedOne = jQuery(data.selected).find('td').eq('1').text();

			// set the input value
			jQuery('.mySearch_to_station').val(selectedOne);

			// hide the result
			jQuery(".mySearch_to_station").trigger('ajaxlivesearch:hide_result');

		},
		onAjaxComplete: function(e, data) {

		}
	});
		jQuery(".mySearch_train").ajaxlivesearch({
			loaded_at: <?php echo $time; ?>,
			token: <?php echo "'" . $token . "'"; ?>,
			maxInput: <?php echo $maxInputLength; ?>,
			onResultClick: function(e, data) {
			// get the index 1 (second column) value
			var selectedOne = jQuery(data.selected).find('td').eq('1').text();

			// set the input value
			jQuery('.mySearch_train').val(selectedOne);

			// hide the result
			jQuery(".mySearch_train").trigger('ajaxlivesearch:hide_result');

		},
		onResultEnter: function(e, data) {
			// get the index 1 (second column) value
			var selectedOne = jQuery(data.selected).find('td').eq('1').text();

			// set the input value
			jQuery('.mySearch_train').val(selectedOne);

			// hide the result
			jQuery(".mySearch_train").trigger('ajaxlivesearch:hide_result');

		},
		onAjaxComplete: function(e, data) {

		}
	});
	})
	var text_fs = $(".mySearch_from_station").val();
	jQuery(".from_station").val(text_fs);

	var text_ts = $(".mySearch_to_station").val();
	jQuery(".to_station").val(text_ts);

	var text_t = $(".mySearch_train").val();
	jQuery(".train").val(text_t);
</script>
