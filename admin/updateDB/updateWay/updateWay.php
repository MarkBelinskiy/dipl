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
$select_id = $db->query("select max(Way_ID) from Way");
$last_id = $db->get_assoc($select_id);
$last_id = $last_id['max(Way_ID)'];

$way_id = $_REQUEST["way_id"];

if ($way_id < 1 || $way_id > $last_id) {
    die('<p class="way_form">Введите корректный id категории вагона</p>');
}

$select = $db->query("select * from Way where Way_ID = {$way_id}");
$select_ass = $db->get_assoc($select);
$list_id = $select_ass['List_ID'];
$station_id = $select_ass['Station_ID'];
$time_of_arrival = $select_ass['TimeOfArrival'];
$time_of_departure = $select_ass['TimeOfDeparture'];
$day_way = $select_ass['DayOfWay'];

$select_st = $db->query("select Station from Station where Station_ID='{$station_id}'");
$station = $db->get_assoc($select_st)['Station'];
/*
print_r($list_id."<br>".$station."<br>".$time_of_arrival."<br>".$time_of_departure."<br>".$day_way."<br>");*/
?>
<form class="way_form" action="updateDB/updateWay/way_to_db.php">

    <input  type="hidden" name="way_id" value="<?php echo $way_id ?>" />
    <input  type="hidden" name="list_id" value="<?php echo $list_id ?>" />


    <p>Введите станцию :</p>
    <input type="text" value="<?php echo $station ?>" name="station" class='mySearch_station' id="ls_query_station" placeholder="Начните печатать ...">
    <input hidden type="text" class="station" name="station" /><br><br>

    <p>Введите время прибытия на станцию</p>
    <input type="time" name="time_of_arrival" value="<?php echo $time_of_arrival ?>"  /><br><br>

    <p>Введите время отправления со станции</p>
    <input type="time" name="time_of_departure" value="<?php echo $time_of_departure ?>" />
    <p>День пути</p>
    <select name="day_way">
        <option <?php  echo ($day_way == 0)?"selected":"" ?> value="0">0</option>
        <option <?php  echo ($day_way == 1)?"selected":"" ?> value="1">1</option>
        <option <?php  echo ($day_way == 2)?"selected":"" ?> value="2">2</option>
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

    var text_s = $(".mySearch_station").val();
    jQuery(".station").val(text_s);
</script>
