<?php

defined('ROOT') or die('No direct script access.');

class CView {

    private $vars;
    private $file;

    function __construct($filename = "") {
        $this->file = $filename;
        $this->vars = array();
    }

    function __set($name, $value) {
        $this->vars[$name] = $value;
    }

    function assign($prm_data) {
        if (!isset($prm_data['msg'])) {
            $prm_data['msg'] = "";
        }
        $this->vars = $prm_data;
    }

    function fetch($filename = "") {
        
        ob_start();
        extract($this->vars, EXTR_SKIP);
        include ("config.php");
        $filename = $filename.'.php';
        $view_file = $config['SYSPATH'] . "/views/404.php";
        if (file_exists($config['SYSPATH'] . "/views/v" . $filename)) {
            $view_file = $config['SYSPATH'] . "/views/v" . $filename;
        } else if (file_exists($config['APPPATH'] . "/views/v" . $filename)) {
            $view_file = $config['APPPATH'] . "/views/v" . $filename;
        }
        require ROOT . DIRECTORY_SEPARATOR . $view_file;
        return ob_get_clean();
    }

    function display($param) {
        echo self::fetch($param);
    }

}

?>