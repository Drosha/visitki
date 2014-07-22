<?php

function disabled_state($disabled) {
    return (($disabled == 1) ? ' disabled ' : '');
}

function form_combo($prmName, $prmValue, $prmList, $disabled = 0) {
    $str = '<select name="' . $prmName . '" ' . disabled_state($disabled) . '>';

    foreach ($prmList as $row) {
        if ($row['id'] == $prmValue) {
            $str .= '<option selected value="' . $row['id'] . '">' . $row['title'] . '</option>';
        } else {
            $str .= '<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
        }
    }
    $str .= '</select>';

    return $str;
}

function form_checkbox($prmName, $prmValue, $disabled = 0) {
    return '<input type="checkbox" name="' . $prmName . '" id="'
            . $prmName . '" ' . (($prmValue == 1) ? " checked=true " : "")
            . disabled_state($disabled) . '>';
}

function form_text($prmName, $prmRows, $prmCols, $prmValue, $disabled = 0) {
    return '<textarea name="' . $prmName . '" rows="' . $prmRows
            . '" cols="' . $prmCols . '"' . disabled_state($disabled) . '>'
            . $prmValue . '</textarea>';
}

function form_edit($prmName, $prmSize, $prmValue, $disabled = 0) {
    return '<input name="' . $prmName . '" type="text" size="' . $prmSize . '"'
            . ' value="' . $prmValue . '" ' . disabled_state($disabled) . '>';
}

function form_ahref($prmTitle, $prmPath) {
    return '<a href="' . $prmPath . '">' . $prmTitle . '</a>';
}

function image($path, $alt = "") {
    return "<img src = '$path' alt='$alt'>";
}

?>