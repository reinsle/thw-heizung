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
            $events = Event::model()->findAllBySql("SELECT * FROM tbl_event WHERE datetime('now') BETWEEN datetime(datetime(start, 'unixepoch'), '-240 minutes') AND datetime(ende, 'unixepoch') AND LOWER(location) = 'unterkunft ov kempten' AND active = 1");
            if (count($events)) {
                $this->actionSwitchOn();
            } else {
                $this->actionSwitchOff();
            }
        }
    }

    /**
     * Strip control characters from String
     *
     * @param $text text to strip characters from
     * @return mixed striped text
     */
    private function stripString($text)
    {
        for ($control = 0; $control < 32; $control++) {
            $text = str_replace(chr($control), "", $text);
        }
        $text = str_replace(chr(127), "", $text);
        return $text;
    }

    /**
     * Show debug informations
     */
    public function actionDebug()
    {
        $data = History::model()->findAllBySql("SELECT * FROM tbl_history WHERE tst >= datetime('now', '-30 minutes')");
        echo "History-Eintraege der letzten 30 min: " . count($data) . "\r\n";
        $data = Event::model()->findAllBySql("SELECT * FROM tbl_event WHERE datetime('now') BETWEEN datetime(datetime(start, 'unixepoch'), '-300 minutes') AND datetime(ende, 'unixepoch') AND LOWER(location) = 'unterkunft ov kempten' AND active = 1");
        echo "Aktuelle Event-Eintraege: " . count($data) . "\r\n";
    }

    /**
     * Manually switch heater on
     */
    public function actionSwitchOn()
    {
        $output = $this->stripString(shell_exec('/usr/local/bin/gpio read 0'));
        if ($output === '0') {
            $model = new History();
            $model->name = 'Switch heater on';
            $model->save();
            shell_exec('/usr/local/bin/gpio write 0 1');
        }
    }

    /**
     * Manually switch heater off
     */
    public function actionSwitchOff()
    {
        $output = $this->stripString(shell_exec('/usr/local/bin/gpio read 0'));
        if ($output === '1') {
            $model = new History();
            $model->name = 'Switch heater off';
            $model->save();
            shell_exec('/usr/local/bin/gpio write 0 0');
        }
    }

}
