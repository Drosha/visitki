<?php

defined('ROOT') or die('No direct script access.');

class CWidgets extends CController {

    //! widget возвращает значение, а не сразу выводит на экран
    public function widget_login() {
        $view = new CView();
        return $view->fetch("login");
    }

}
