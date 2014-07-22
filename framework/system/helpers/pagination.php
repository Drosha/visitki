<?php

function NavigationUrl($page, $total, $url) {
    $pervpage = (($page == 1) ? "" : "<li><a href=\"" . $url . ($page - 1) . "\">Назад</a></li>");
    $nextpage = (($total > $page) ? "<li><a href=\"" . $url . ($page + 1) . "\">Далее</a></li>" : "");

    if ($page >= 5) {
        $p0l = "<li><a href=\"" . $url . "1\">1</a></li>";
    }
    if ($page >= 5) {
        $p4l = " ... ";
    }
    if ($page - 3 > 0) {
        $p3l = "<li><a href=\"" . $url . ($page - 3) . "\">" . ($page - 3) . "</a></li>";
    }
    if ($page - 2 > 0) {
        $p2l = "<li><a href=\"" . $url . ($page - 2) . "\">" . ($page - 2) . "</a></li>";
    }
    if ($page - 1 > 0) {
        $p1l = "<li><a href=\"" . $url . ($page - 1) . "\">" . ($page - 1) . "</a></li>";
    }

    if ($page + 3 <= $total) {
        $p3r = "<li><a href=\"" . $url . ($page + 3) . "\">" . ($page + 3) . "</a></li>";
    }
    if ($page + 2 <= $total) {
        $p2r = "<li><a href=\"" . $url . ($page + 2) . "\">" . ($page + 2) . "</a></li>";
    }
    if ($page + 1 <= $total) {
        $p1r = "<li><a href=\"" . $url . ($page + 1) . "\">" . ($page + 1) . "</a></li>";
    }

    return "<div class=pagination><ul class=pagination>" . $pervpage . $p0l . $p4l . $p3l . $p2l . $p1l . "<b>" . $page . "</b>" . $p1r . $p2r . $p3r . $nextpage . "</ul></div>";
}

?>