<?php

defined('ROOT') or die('No direct script access.');

class CMain extends CController {
    public function action_getbackgrounds() {
        $db = CDBConnection::getInstance();
        $backgrounds = $db->fetch_all("select title AS label, value from backgrounds");
        echo json_encode($backgrounds);
    }

    public function action_save() {
        $db = CDBConnection::getInstance();

        $params = json_decode(file_get_contents('php://input'));

        $sid = $params->sid;
        if (!empty($sid)) {
            $db->execute('update builds set details=\''.json_encode($params).'\' where sid=\''.$sid.'\'');
        }else {
            $sid = md5(time() . session_id());
            $db->execute('insert into builds values(\''.$sid.'\', \''.json_encode($params).'\')');
            echo json_encode(array('sid' => $sid));
        }
    }
}