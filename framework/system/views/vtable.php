<?php

defined('ROOT') or die('No direct script access.');
echo "<!DOCTYPE html> <html>";
include ("config.php");

//include_once ($config['SYSPATH'] . "/helpers/forms.php");

$baseurl = $config['BASEPATH'];

if (count($table_data) == 0) {
    if (count($ar_acts) > 0) {
        if (!in_array("add", $arr_exclude)) {
            echo "<tr><td colspan=$col_count><a href='$baseurl/"
            . $ar_acts[0]['controller'] . "/add'>"
            . "<img src='$baseurl/img/add.png'></a></td></tr>";
        }
    }

    return;
}

if ($ar_links == "") {
    $ar_links = array();
}

$col_count = 0;
echo "<table class=tablegrid>";

echo "<tr>";
foreach (array_keys($table_data[0]) as $key) {
    if (!in_array($key, $arr_exclude)) {
        echo "<th>$key</th>";
        $col_count++;
    }
}
if (count($ar_acts) > 0) {
    echo "<th>&nbsp;</th>";
    $col_count++;
}

echo "</tr>";


if (count($ar_acts) > 0) {
    if (!in_array("add", $arr_exclude)) {
        echo "<tr><td colspan=$col_count><a href='$baseurl/" . $ar_acts[0]['controller'] . "/add'><img src='$baseurl/img/add.png'></a></td></tr>";
    }
}

$grp_key = "";

foreach ($table_data as $row) {
    if ($ar_groupby != "") {
        $grp_key_cur = "";
        foreach ($ar_groupby as $grpcol) {
            $grp_key_cur .= $row[$grpcol] . "; ";
        }
    }
    if ($grp_key != $grp_key_cur) {
        echo "<tr><td colspan=$col_count align=center bgcolor=#e0e0e0><strong>$grp_key_cur</strong></td></tr>";
        $grp_key = $grp_key_cur;
    }


    echo "<tr>";
    foreach (array_keys($row) as $key) {
        if (!in_array($key, $arr_exclude)) {
            $str_td = "";
            if (count($ar_links) > 0) {
                foreach ($ar_links as $link) {
                    if ($link['field'] == $key) {
                        $str_td = "<a href='{$link['ref']}" . $row[$link['param']] . "'>" . $row[$key] . "</a>";
                        break;
                    } else {
                        $str_td = $row[$key];
                    }
                }
            } else {
                $str_td = $row[$key];
            }
            echo "<td>" . $str_td . "</td>";
        }
    }
    if (count($ar_acts) > 0) {
        echo "<td>";
        foreach ($ar_acts as $act_row) {
            foreach ($act_row['acts'] as $act) {
                if ($act != "add") {
                    echo "&nbsp;<a href='$baseurl/" . $act_row['controller'] . "/" . $act . "/id/" . $row['id'] . "'><img src='$baseurl/img/$act.png'></a>";
                }
            }
        }
        echo "</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>
