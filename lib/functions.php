<?php 
function create_select($name, $select_array,$static)
{
    $to_select = "<select  name=\"". $name."\">\n";
    foreach ($select_array as $key => $value) {
        $to_select .= "<option";
        if ($static == $key) {
            $to_select .= " selected";
        }
        $to_select .= " value=". $key .">". $value ."</option>\n";
    }
    $to_select .= "</select>\n";
    
    return $to_select;
}


 ?>