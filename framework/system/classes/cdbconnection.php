<?php

class CDBConnection {

    static private $instance = NULL;
    private $dbh;
    private $dbprefix;

    static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new CDBConnection();
        }
        return self::$instance;
    }

    private function __construct() {
        include ("config.php");
        
        $this->dbprefix = $config['dbprefix'];

        $server_name = $config['server_name'];
        $base_user = $config['base_user'];
        $base_pass = $config['base_pass'];
        $db_name = $config['base_name'];
        
        if ($server_name != "") {
            try {
                $this->dbh = new PDO('mysql:host=' . $server_name . ';dbname=' . $db_name, $base_user, $base_pass);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

    private function parse_dbprefix($param) {
        return str_replace("##_", $this->dbprefix, $param);
    }

    private function __clone() {
        
    }

    public function dbcon() {
        return $this->dbh;
    }

    public function select($sqltext) {
        $res = $this->dbh->query(self::parse_dbprefix($sqltext));
        return $res;
    }

    public function execute($prmSqlText, $prmParams = 0) {
        $sth = $this->dbh->prepare(self::parse_dbprefix($prmSqlText));
        if ($prmParams == 0) {
            $sth->execute();
        } else {
            $sth->execute($prmParams);
        }
        return $sth;
    }

    public function fetch($prmSqlText, $prmParams = 0) {
        $sth = self::execute($prmSqlText, $prmParams);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function fetch_all($prmSqlText, $prmParams = 0) {
        $sth = self::execute($prmSqlText, $prmParams);
        return $sth->fetchALL(PDO::FETCH_ASSOC);
    }

    public function row_by_id($prmTable, $prmID) {
        $query = "select * from `" . self::parse_dbprefix($prmTable) . "` where `id`=:id";
        $sth = $this->dbh->prepare($query);
        $sth->execute(array(':id' => $prmID));
        return $sth->fetch(PDO::FETCH_BOTH);
    }

    public function insert_array($prmTable, $prmData) {
        $fields = "";
        $fieldsVals = "";
        foreach (array_keys($prmData) as $key) {
            $fields .= (($fields == "") ? '' : ',') . $key;
            $fieldsVals .= (($fieldsVals == "") ? ':' : ',:') . $key;
        }
        $query = "insert into " . self::parse_dbprefix($prmTable) . " ({$fields}) values ({$fieldsVals})";

        // echo $query;
        // print_r($prmData);

        self::execute($query, $prmData);
        return $this->dbcon()->lastInsertId();
    }

    public function update_by_id($prmTable, $prmData) {
        $fieldsVals = "";
        foreach (array_keys($prmData) as $key) {
            if ($key != "id") {
                $fieldsVals .= (($fieldsVals == "") ? "{$key} = :{$key}" : " , {$key} = :{$key}");
            }
        }
        $query = "update {$prmTable} set {$fieldsVals} where id = :id";
        $this->exec(self::parse_dbprefix($query), $prmData);
    }

}

?>