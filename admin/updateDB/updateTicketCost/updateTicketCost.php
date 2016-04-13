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



$select_id = $db->query("select max(TicketCost_ID) from TicketCost");
$last_id = $db->get_assoc($select_id);
$last_id = $last_id['max(TicketCost_ID)'];

$ticket_cost_id = $_REQUEST["ticket_cost_id"];

if ($ticket_cost_id < 1 || $ticket_cost_id > $last_id) {
    die('<p class="ticket_cost_form">Введите корректный id категории вагона</p>');
}

$select = $db->query("select * from TicketCost where TicketCost_ID = {$ticket_cost_id}");
$select_ass = $db->get_assoc($select);
$ticket_cost = $select_ass['TicketCost'];
$way_id = $select_ass['Way_ID'];
$wagon_category_id = $select_ass['WagonCategory_ID'];


$select_way = $db->query("select Way_ID from Way where Station_ID='{$station_id}'");
$station = $db->get_assoc($select_st)['Station'];

?>
<form class="ticket_cost_form" action="updateDB/updateTicketCost/ticket_cost_to_db.php">
    <input  type="hidden" name="ticket_cost_id" value="<?php echo $ticket_cost_id ?>" />
    <input  type="hidden" name="way_id" value="<?php echo $way_id ?>" />
    <br><br>
    <label> Выберите категорию вагона: </label><br>
    <?php 
    echo create_select("wagon_category_id", $list_wag_cat, $wagon_category_id); 
    ?>
    <br><br>
    <label>Введите Цену :</label><br>
    <input type="text" name="ticket_cost" value="<?php echo $ticket_cost ?>">

    <input type="submit" value="Добавить в БД">

</form><br><br>
