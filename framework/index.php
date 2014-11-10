<?php
/**
 * Created by PhpStorm.
 * User: Drosha
 * Date: 17.07.14
 * Time: 13:46
 */
header('Content-Type: text/html; charset=utf-8');
define('ROOT', dirname(__FILE__));
session_start();
function autoload_classes($param) {
    include(dirname(__FILE__) . "/config.php");

    if (strtolower(substr($param, 0, 1)) == "m") {
        include_once ($config['APPPATH'] . "/models/" . strtolower($param) . ".php");
    }
    if (strtolower(substr($param, 0, 1)) == "c") {
        $part_path = strtolower($param) . ".php";

        if (file_exists($config['SYSPATH'] . "/classes/" . $part_path)) {
            $file = $config['SYSPATH'] . "/classes/" . $part_path;
        } else {
            $file = $config['APPPATH'] . "/controllers/" . $part_path;
        }
        include_once $file;
    }
}

spl_autoload_register('autoload_classes');

function get_params() {
    $param = preg_split("/\//", $_GET['param']);
    $params = array();
    $cnt = count($param);

    if ($cnt == 0)
        return $params;

    for ($i = 2; $i < count($param); $i++) {
        $param_val = "";
        if ($i >= $cnt) {
            break;
        }

        if (($i + 1) >= $cnt) {
            $param_val = "";
        } else {
            $param_val = $param[$i + 1];
        }

        $params[$param[$i]] = $param_val;
        $i++;
    }
    return $params;
}

function run($param) {
    include ("config.php");
    $view = new CView();
    $filename = $config['APPPATH'] . "/controllers/c" . $config['defcontroller'] . ".php";
    if (file_exists($filename)) {
        include_once($filename);
        $str_class = "C" . $config['defcontroller'];
        $arr_meth = get_class_methods(new $str_class);
        $act_for_def_controller = array();
        foreach ($arr_meth as $row) {
            if (substr($row, 0, 7) == "action_") {
                $act_for_def_controller[] = substr($row, 7, strlen($row));
            } else {
                $act_for_def_controller[] = $row;
            }
        }

        if ($param['controller'] == "") {
            $controller_name = $config['defcontroller'];
            $controller_action = $config['defaction'];
        } else {
            if (in_array($param['controller'], $act_for_def_controller)) {
                $controller_name = $config['defcontroller'];
                $controller_action = $param['controller'];
            } else {
                $controller_name = $param['controller'];
                if ($param['action'] == "") {
                    $controller_action = $config['defaction'];
                } else {
                    $controller_action = $param['action'];
                }
            }
        }
        $filename = $config['APPPATH'] . "/controllers/c" . $controller_name . ".php";

        if (file_exists($filename)) {
            include_once($filename);
            $str_class = "C" . $controller_name;
            if (in_array('action_' . $controller_action, get_class_methods(new $str_class))) {
                @call_user_func(array("C" . $controller_name, 'action_' . $controller_action), $param['act_params']);
            } else {
                $view->display("404");
            }
        } else {
            $view->display("404");
        }
    } else {
        $view->display("404");
    }
}

$url_params = preg_split("/\//", $_GET['param']);
$params = get_params();

run
(
    array
    (
        'controller' => $url_params[0],
        'action' => $url_params[1],
        'act_params' => $params,
    )
);