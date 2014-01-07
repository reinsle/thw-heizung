<?php

/**
 * Created by PhpStorm.
 * User: reinsle
 * Date: 04.01.14
 * Time: 15:14
 */
class WireCommand extends CConsoleCommand
{
    /**
     * Initialisation of GPIO
     */
    public function actionInit()
    {
        shell_exec('/usr/local/bin/gpio mode 0 out');
        shell_exec('/usr/local/bin/gpio mode 2 out');
        shell_exec('/usr/local/bin/gpio mode 3 out');
        shell_exec('/usr/local/bin/gpio mode 4 out');
    }

    /**
     * Switch gpio-Ports to control heizung
     */
    public function actionIndex()
    {
        // select history for elements < 30 min old
        $data = History::model()->findAllBySql("SELECT * FROM tbl_history WHERE tst >= NOW() - INTERVAL '30 minutes'");
        if (count($data) == 0) {
            // select event where start >= now() - 5 h and end < now()
            $events = Event::model()->findAllBySql("SELECT * FROM tbl_event WHERE now() BETWEEN to_timestamp(start) - INTERVAL '300 minutes' AND to_timestamp(ende)");
            echo count($events);
        }
    }
}