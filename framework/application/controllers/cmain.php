<?php

defined('ROOT') or die('No direct script access.');

class CMain extends CController {

    public function action_getpositions() {
        include "config.php";
        $fp = file_get_contents($config['BASEPATH'] . '/../data/positions.json');
        echo $fp;
    }

    public function action_getbackgrounds() {
        $db = CDBConnection::getInstance();
        $backgrounds = $db->fetch_all("select title AS label, value from backgrounds");
        echo json_encode($backgrounds);
    }

    public function action_save() {
        $db = CDBConnection::getInstance();

        $params = json_decode(file_get_contents('php://input'));

        //$sid = $params->sid;
        print_r($params);
    }
}