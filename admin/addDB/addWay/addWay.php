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
<form action="addDB/addWay/way_to_db.php">

    <p>Введите id расписания поезда:</p>
    <input  type="text" name="list_name" />


    <p>Введите станцию :</p>
    <input type="text" name="station" class='mySearch_station' id="ls_query_station" placeholder="Начните печатать ...">
    <input hidden type="text" class="station" name="station" />

    <p>Введите время прибытия на станцию</p>
    <input type="time" name="time_of_arrival"  /><br><br>

    <p>Введите время отправления со станции</p>
    <input type="time" name="time_of_departure" />
    <p>День пути</p>
    <select name="day_way">
        <option selected value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
    </select>

    <input type="submit" value="Добавить в БД">


</form><br><br>

<script type="text/javascript" src="js/ajaxlivesearch.js"></script>

<script>
    jQuery(document).ready(function(){


        jQuery(".mySearch_station").ajaxlivesearch({
            loaded_at: <?php echo $time; ?>,
            token: <?php echo "'" . $token . "'"; ?>,
            maxInput: <?php echo $maxInputLength; ?>,
            onResultClick: function(e, data) {
            // get the index 1 (second column) value
            var selectedOne = jQuery(data.selected).find('td').eq('1').text();

            // set the input value
            jQuery('.mySearch_station').val(selectedOne);

            // hide the result
            jQuery(".mySearch_station").trigger('ajaxlivesearch:hide_result');
            jQuery(".station").val(selectedOne);

        },
        onResultEnter: function(e, data) {
            // get the index 1 (second column) value
            var selectedOne = jQuery(data.selected).find('td').eq('1').text();

            // set the input value
            jQuery('.mySearch_station').val(selectedOne);

            // hide the result
            jQuery(".mySearch_station").trigger('ajaxlivesearch:hide_result');
            jQuery(".station").val(selectedOne);

        },
        onAjaxComplete: function(e, data) {

        }
    });
        
    })


</script>
