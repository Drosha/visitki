<?php

defined('ROOT') or die('No direct script access.');

class MUsers extends CModel {

    private $data;

    public function get_by_id($params) {
        $data = self::get_list();
        $id = (int) $params;
        foreach ($this->data as $row) {
            if ($row['id'] == $id) {
                return $row;
            }
        }
        return array('id' => 0, 'login' => '');
    }

    public function get_list() {

        for ($i = 1; $i < 6; $i++) {
            $this->data[] = array('id' => $i, 'login' => 'user ' . $i, 'pw' => ($i * 2 + $i));
        }
        return $this->data;
    }

}

?>