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
        $data = History::model()->findAllBySql("SELECT * FROM tbl_history WHERE tst >= NOW() - INTERVAL '30 minutes'");
        if (count($data) == 0) {
            echo "ZZZ";
        }
        echo "...";
    }

}