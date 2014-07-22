<?php

defined('ROOT') or die('No direct script access.');

class MTable extends CModel {

    public function get_by_id($params) {
        $sql = "select * from " . $params['table'] . " where id=" . (int) $params['id'];
        $data = self::fetch($sql);
        return $data;
    }

}

?>