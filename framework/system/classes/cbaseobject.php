<?php

defined('ROOT') or die('No direct script access.');

abstract class CBaseObject {

    public function clear($var) {
        $var = strip_tags($var);
        $var = str_replace("\n", " ", $var);
        $var = str_replace("\r", "", $var);
        $var = htmlspecialchars($var, ENT_QUOTES);
        return $var;
    }

    public function escape($var) {
        $var = htmlspecialchars($var, ENT_QUOTES);
        return $var;
    }

    public function escape_array($param) {
        $arr_new = array();
        foreach (array_keys($param) as $key) {
            $arr_new[$key] = self::escape($param[$key]);
        }
        return $arr_new;
    }

    public function debug_msg($prm_msg) {
        echo "<br><b>debug:</b> $prm_msg<br>";
    }
}

?>