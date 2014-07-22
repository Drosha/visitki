<?php

defined('ROOT') or die('No direct script access.');

abstract class CController extends CBaseObject {

    public function execute($prm_controller, $prm_action = "", $params = "") {
        include("config.php");
        $filename = $config['APPPATH'] . "/controllers/c" . $prm_controller . ".php";

        if (file_exists($filename)) {
            include_once($filename);
            $controller_name = $prm_controller;
            $controller_action = ($prm_action == "") ? "index" : $prm_action;
            return call_user_func(array("C" . $controller_name, $controller_action), $params);
        }
    }

    public function redirect($params) {
        include ("config.php");
        header("Location: http://" . $_SERVER['HTTP_HOST'] . $config['BASEPATH'] . $params);
    }
}

?>