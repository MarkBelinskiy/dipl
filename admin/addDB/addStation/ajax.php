<?php 
$coord = $_REQUEST["coord"];
$coord_ex = explode(",", $coord);
unset($coord_ex[4]);

$coord_ex[0] = round($coord_ex[0], 4);
$coord_ex[1] = round($coord_ex[1], 4);
$str = "<p> Координаты города $coord_ex[2], $coord_ex[3]: <br>";
$str .= "$coord_ex[0]"."<br>";
$str .= "$coord_ex[1]"."<br></p>";
$str .= '<form method="post"  action="addDB/addStation/to_db.php">';
$str .=	'<input type="hidden" name="arr" value="'.implode(",", $coord_ex).'" />';
$str .=	'<input type="submit" value="Добавить в БД" /></form>';



print_r($str);
?>