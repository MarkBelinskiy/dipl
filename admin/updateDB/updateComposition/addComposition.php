<?php
require_once $_SERVER[DOCUMENT_ROOT].'/lib/db.php';
require_once $_SERVER[DOCUMENT_ROOT].'/lib/functions.php';

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
$select_category = $db->query('select * from WagonCategory');
$id_wag_cat = array();
$wag_cat = array();

while ($row = $db->get_assoc($select_category)) {
    foreach ($row as $key => $value) {
        if ($key == 'WagonCategory_ID') {
            $id_wag_cat[]=$value;
        } elseif ($key == 'WagonCategory') {
            $wag_cat[]=$value;
        }
    }

}
$list_wag_cat = array_combine($id_wag_cat, $wag_cat);
?>

<!DOCTYPE html>
<html >
<head>
   <link href='http://fonts.googleapis.com/css?family=Quattrocento+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <meta charset="utf-8">

   <title>Добавление состава</title>

   <!-- Live Search Styles -->
   <link rel="stylesheet" href="css/fontello.css?1">
   <link rel="stylesheet" href="css/animation.css?1">
    <!--[if IE 7]>
    <link rel="stylesheet" href="css/fontello-ie7.css">
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="css/ajaxlivesearch.css?1">
</head>
<body>


    <form action="composition_to_db.php">

        <label> Выберите категорию вагона: </label><br>
        <?php 
        echo create_select("wagon_category", $list_wag_cat); 
        ?>

        <br><br>
        <p>Введите название поезда:</p>
        <input  type="text" name="train" class='mySearch_3' id="ls_query_3" placeholder="Начните печатать ...">
        <input hidden type="text" class="train" name="train" /><br>

        <input type="submit" value="Добавить в БД">

    </form><br><br>


    <input type="submit" onclick="select_list()" value="Вывести расписание на экран">
    <input type="submit" onclick="select_way()" value="Вывести путь на экран">
    <input type="submit" onclick="select_ticket_cost()" value="Вывести цены билетов на экран">
    <input type="submit" onclick="select_composition()" value="Вывести составы поездов на экран">



    <div class="select_list"></div><br><br>
    <div class="select_way"></div><br><br>
    <div class="select_ticket_cost"></div><br><br>
    <div class="select_composition"></div><br><br>



    <script src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="js/ajaxlivesearch.js"></script>

    <script>
        function select_list() {
            $.ajax({ 
     type:'post',//тип запроса: get,post либо head
     url:'select_list.php',//url адрес файла обработчика
     response:'text',//тип возвращаемого ответа text либо xml
     success:function (data) {//возвращаемый результат от сервера
        $('.select_list').html(data);
    }
});
        }

        function select_way() {
            $.ajax({ 
     type:'post',//тип запроса: get,post либо head
     url:'select_way.php',//url адрес файла обработчика
     response:'text',//тип возвращаемого ответа text либо xml
     success:function (data) {//возвращаемый результат от сервера
        $('.select_way').html(data);
    }
});
        }

        function select_ticket_cost() {
            $.ajax({ 
     type:'post',//тип запроса: get,post либо head
     url:'select_ticket_cost.php',//url адрес файла обработчика
     response:'text',//тип возвращаемого ответа text либо xml
     success:function (data) {//возвращаемый результат от сервера
        $('.select_ticket_cost').html(data);
    }
});
        }
        
 function select_composition() {
        $.ajax({ 
     type:'post',//тип запроса: get,post либо head
     url:'select_composition.php',//url адрес файла обработчика
     response:'text',//тип возвращаемого ответа text либо xml
     success:function (data) {//возвращаемый результат от сервера
        $('.select_composition').html(data);
    }
});
    }
        jQuery(document).ready(function(){
            
            jQuery(".mySearch_3").ajaxlivesearch({
                loaded_at: <?php echo $time; ?>,
                token: <?php echo "'" . $token . "'"; ?>,
                maxInput: <?php echo $maxInputLength; ?>,
                onResultClick: function(e, data) {
            // get the index 1 (second column) value
            var selectedOne = jQuery(data.selected).find('td').eq('1').text();

            // set the input value
            jQuery('.mySearch_3').val(selectedOne);

            // hide the result
            jQuery(".mySearch_3").trigger('ajaxlivesearch:hide_result');
            jQuery(".train").val(selectedOne);

        },
        onResultEnter: function(e, data) {
            // get the index 1 (second column) value
            var selectedOne = jQuery(data.selected).find('td').eq('1').text();

            // set the input value
            jQuery('.mySearch_3').val(selectedOne);

            // hide the result
            jQuery(".mySearch_3").trigger('ajaxlivesearch:hide_result');
            jQuery(".train").val(selectedOne);

        },
        onAjaxComplete: function(e, data) {

        }
    });
        })


    </script>
</body>
</html>