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
        shell_exec('/usr/local/bin/gpio write 0 1');
        shell_exec('/usr/local/bin/gpio mode 2 out');
        shell_exec('/usr/local/bin/gpio write 2 1');
        shell_exec('/usr/local/bin/gpio mode 3 out');
        shell_exec('/usr/local/bin/gpio write 3 1');
        shell_exec('/usr/local/bin/gpio mode 4 out');
        shell_exec('/usr/local/bin/gpio write 4 1');
    }

    /**
     * Switch gpio-Ports to control heizung
     */
    public function actionIndex()
    {
        // select history for elements < 30 min old
        $data = History::model()->findAllBySql("SELECT * FROM tbl_history WHERE tst >= datetime('now', '-30 minutes')");
        if (count($data) == 0) {
            // select event where start >= now() - 5 h and end < now()
            $events = Event::model()->findAllBySql("SELECT * FROM tbl_event WHERE datetime('now') BETWEEN datetime(datetime(start, 'unixepoch'), '-300 minutes') AND datetime(ende, 'unixepoch')");
            $output = shell_exec('/usr/local/bin/gpio read 0');
            if (count($events)) {
                // Switch heizung to on
                if ($output === '1') {
                    $model = new History();
                    $model->name = 'Switch heater on';
                    $model->tst = new DateTime();
                    $model->save();
                    shell_exec('/usr/local/bin/gpio write 0 0');
                }
            } else {
                // Switch heizung to off
                if ($output === '0') {
                    $model = new History();
                    $model->name = 'Switch heater off';
                    $model->tst = new DateTime();
                    $model->save();
                    shell_exec('/usr/local/bin/gpio write 0 1');
                }
            }
        }
    }
}