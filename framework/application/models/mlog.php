<?php

defined('ROOT') or die('No direct script access.');

class MLog extends CModel {

    //! Регистрация входа в систему
    public function start_session($params) {
        return self::insert_array("##_log", $params);
    }

    //! Проверка наличия сессии с указанного IP
    public function check_login($params) {
        $prm_data = array(':id' => $params['suid'], ':ip' => $_SERVER['REMOTE_ADDR']);
        $data = self::fetch_all("select id from ##_log where id = :id and ip = :ip", $prm_data);
        if (count($data) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}

?>