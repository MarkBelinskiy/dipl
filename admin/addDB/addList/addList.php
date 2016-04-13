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

?>
<form action="addDB/addList/list_to_db.php">

	<p>Введите станцию отправления:</p>
	<input  type="text" name="from_station" class='mySearch_from_station' id="ls_query_from_station"  placeholder="Начните печатать ..."/>

	<input hidden type="text" class="from_station" name="from_station" /><br>

	<p>Введите станцию прибытия:</p>
	<input type="text" name="to_station" class='mySearch_to_station' id="ls_query_to_station" placeholder="Начните печатать ...">
	<input hidden type="text" class="to_station" name="to_station" /><br>


	<p>Введите название поезда:</p>
	<input  type="text" name="train" class='mySearch_train' id="ls_query_train" placeholder="Начните печатать ...">
	<input hidden type="text" class="train" name="train" /><br>


	<p>Введите дату отправления</p>
	<input type="date" name="start" /><br><br>

	<p>Введите дату прибытия</p>
	<input type="date" name="finish" /><br><br>

	<p>Введите минимальную цен билета</p>
	<input type="text" name="min_cost" /><br><br>

	<p>Введите расписание поезда</p>
	<select name="list">
		<option value="0">Каждый день</option>
		<option value="1">По нечетным</option>
		<option value="2">По четным</option>
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
			jQuery(".from_station").val(selectedOne);

		},
		onResultEnter: function(e, data) {
			// get the index 1 (second column) value
			var selectedOne = jQuery(data.selected).find('td').eq('1').text();

			// set the input value
			jQuery('.mySearch_from_station').val(selectedOne);

			// hide the result
			jQuery(".mySearch_from_station").trigger('ajaxlivesearch:hide_result');
			jQuery(".from_station").val(selectedOne);
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
			jQuery(".to_station").val(selectedOne);

		},
		onResultEnter: function(e, data) {
			// get the index 1 (second column) value
			var selectedOne = jQuery(data.selected).find('td').eq('1').text();

			// set the input value
			jQuery('.mySearch_to_station').val(selectedOne);

			// hide the result
			jQuery(".mySearch_to_station").trigger('ajaxlivesearch:hide_result');
			jQuery(".to_station").val(selectedOne);

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
			jQuery(".train").val(selectedOne);

		},
		onResultEnter: function(e, data) {
			// get the index 1 (second column) value
			var selectedOne = jQuery(data.selected).find('td').eq('1').text();

			// set the input value
			jQuery('.mySearch_train').val(selectedOne);

			// hide the result
			jQuery(".mySearch_train").trigger('ajaxlivesearch:hide_result');
			jQuery(".train").val(selectedOne);

		},
		onAjaxComplete: function(e, data) {

		}
	});
	})

</script>
