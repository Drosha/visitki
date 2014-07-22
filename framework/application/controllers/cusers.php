<?php

defined('ROOT') or die('No direct script access.');

class CUsers extends CController {

    //! Префикс "action_"  означет что метод может быть использован в адресе
    public function action_index($params) {
        self::redirect("/users/list");
    }

    public function action_edit($params) {
        parent::execute("main", "action_edit", $params);
    }

    public function action_save($params) {
        self::redirect("");
    }

}

?>