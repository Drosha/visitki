<?php

defined('ROOT') or die('No direct script access.');

include_once("cdbconnection.php");

abstract class CModel extends CBaseObject {

    private $dbc;

    function __construct($filename = "") {
        $this->dbc = CDBConnection::getInstance();
    }

    public function db() {
        return $this->dbc;
    }

    public function add_sql_debug($prm_msg) {
        return $this->db()->insert_array("debugmessages", array('text' => $prm_msg));
    }

    public function fetch_all($prmSqlText, $prmParams = 0) {
        return $this->db()->fetch_all($prmSqlText, $prmParams);
    }

    public function fetch($prmSqlText, $prmParams = 0) {
        return $this->db()->fetch($prmSqlText, $prmParams);
    }

    public function execute($prmSqlText, $prmParams) {
        return $this->db()->execute($prmSqlText, $prmParams);
    }

    public function insert_array($prmTable, $prmData) {
        return $this->db()->insert_array($prmTable, $prmData);
    }

    public function select($sqltext) {
        return $this->db()->select($sqltext);
    }

    public function update_by_id($prmTable, $prmData) {
        $this->db()->update_by_id($prmTable, $prmData);
    }

}

?>