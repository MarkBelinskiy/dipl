<?php
require_once $_SERVER[DOCUMENT_ROOT].'/lib/db.php';
require_once $_SERVER[DOCUMENT_ROOT].'/lib/functions.php';


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
    <form action="addDB/addTicketCost/ticket_cost_to_db.php">
        <label>Введите id пути поезда:</label><br>
        <input  type="text" name="id_way" />
<br><br>
        <label> Выберите категорию вагона: </label><br>
        <?php 
        echo create_select("wagon_category", $list_wag_cat); 
        ?>

<br><br>
        <label>Введите Цену :</label><br>
        <input type="text" name="ticket_cost">

        <input type="submit" value="Добавить в БД">

    </form><br><br>
