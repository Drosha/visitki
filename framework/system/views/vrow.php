<?php

defined('ROOT') or die('No direct script access.');
echo "<!DOCTYPE html> <html>";

include ("config.php");
include_once ($config['SYSPATH'] . "/helpers/constructforms.php");

$baseurl = $config['BASEPATH'];
if ($controller['name'] != "") {
    echo "<form action='$baseurl/{$controller['name']}/{$controller['act']}' method=post>";
} else {
    echo "<form>";
}

echo "<table>";

foreach ($arr_cols as $col) {
    $disabled = (isset($col['disabled']) ? $col['disabled'] : 0);
    
    echo "<tr>";

    if ($col['type'] == 'edit') {
        echo "<td>" . $col['title'] . "</td>";
        echo "<td>" . form_edit($col['name'], $col['size'], $data[$col['name']], $disabled) . "</td>";
    }
    if ($col['type'] == 'select') {
        $col_name = str_replace("_select", "", $col['name']);
        echo "<td>" . $col['title'] . "</td>";
        echo "<td>" . form_combo($col_name, $data[$col_name], $col['data']) . "</td>";
    }
    if ($col['type'] == 'text') {
        echo "<td>" . $col['title'] . "</td>";
        echo "<td>" . form_text($col['name'], $col['rows'], $col['cols'], $data[$col['name']], $disabled) . "</td>";
    }
    if ($col['type'] == 'checkbox') {
        echo "<td>&nbsp;</td>";
        echo "<td>" . form_checkbox($col['title'], $col['name'], $data[$col['name']], $disabled) . "</td>";
    }
    if ($col['type'] == 'hidden') {
        echo "<td><input type=hidden value='{$data[$col['name']]}' name='{$col['name']}' id='{$col['name']}'></td>";
    }
    echo "</tr>";
}
echo "</table>";
if ($controller['name'] != "") {
    echo "<input type=submit value='Сохранить' />";
}
echo "</form>";
?>