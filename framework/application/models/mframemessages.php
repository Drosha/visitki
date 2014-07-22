<?php

defined('ROOT') or die('No direct script access.');

//! Вывод сообщений пользователю после перезагрузки страницы
class MFrameMessages extends CModel {

    //! Добавляем сообщение для фрейма
    public function add($params) {
        self::insert_array("framemessages", $params);
    }

    //! Получаем сообщения фрейма
    public function get_frame_messages($prmFrame, $prmUserID) {
        $rows = parent::fetch_all("select id,message,messtype from framemessages where userid = :pid and framename = :fname"
                        , array(':pid' => $prmUserID, ':fname' => $prmFrame));

        $str = "";
        foreach ($rows as $row) {
            if ($row['id'] != 0) {
                self::execute("delete from framemessages where id=" . $row['id']);
            }

            if ($row['messtype'] == "er") {
                $str .= "<div class=errormes>{$row['message']}</div>";
            } elseif ($row['messtype'] == "inf") {
                $str .= "<div class=infomes>{$row['message']}</div>";
            }
        }
        return $str;
    }

}

?>