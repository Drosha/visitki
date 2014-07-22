<?php

function form_edit($prmLabel, $prmName, $prmSize, $prmValue) {
    echo '<label><div class="label">' . $prmLabel . ': </div><input name="' . $prmName . '" type="text" size="' . $prmSize . '" value="' . $prmValue . '"></label>';
}

function form_combo_db($prmLabel, $prmName, $prmValue, $prmList) {
    echo '<label><div class="label">' . $prmLabel . ': </div><select name="' . $prmName . '" >';

    while ($row = $prmList->fetch(PDO::FETCH_ASSOC)) {
        if ($row['id'] == $prmValue) {
            echo '<option selected value="' . $row['id'] . '">' . $row['title'] . '</option>';
        } else {
            echo '<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
        }
    }
    echo '</select></label>';
}

function form_combo($prmLabel, $prmName, $prmValue, $prmList) {
    echo '<label>' . $prmLabel . ': <select name="' . $prmName . '" >';

    foreach ($prmList as $row) {
        if ($row['id'] == $prmValue) {
            echo '<option selected value="' . $row['id'] . '">' . $row['title'] . '</option>';
        } else {
            echo '<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
        }
    }
    echo '</select></label>';
}

function form_combo_simple($prmLabel, $prmName, $prmValue, $prmList) {
    echo '<label>' . $prmLabel . ': <select name="' . $prmName . '" >';

    foreach ($prmList as $row) {
        echo '<option value="' . $row['title'] . '">' . $row['title'] . '</option>';
    }
    echo '</select></label>';
}

function form_checkbox($prmLabel, $prmName, $prmValue) {
    echo '<label><input type="checkbox" name="' . $prmName . '" id="' . $prmName . '" ' . (($prmValue == 1) ? " checked=true " : "") . '>' . $prmLabel . '</<label>';
}

function form_ahref($prmTitle, $prmPath) {
    echo '<a href="' . $prmPath . '">' . $prmTitle . '</a>';
}

function form_text($prmLabel, $prmName, $prmRows, $prmCols, $prmValue) {
    echo '<label><div class="label">' . $prmLabel . ': </div><textarea name="' . $prmName . '" rows="' . $prmRows . '" cols="' . $prmCols . '">' . $prmValue . '</textarea></label>';
}

function image($path, $alt = "") {
    echo "<img src = '$path' alt='$alt'>";
}

?>