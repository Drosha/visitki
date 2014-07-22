<?php

defined('ROOT') or die('No direct script access.');

class CMain extends CController {

    public function action_getpositions() {
        include "config.php";
        $fp = file_get_contents($config['BASEPATH'] . '/../data/positions.json');
        echo $fp;
    }
}