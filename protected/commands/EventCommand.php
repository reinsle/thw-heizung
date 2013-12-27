<?php
/**
 * Created by PhpStorm.
 * User: reinsle
 * Date: 27.12.13
 * Time: 17:44
 */

class EventCommand extends CConsoleCommand
{

    public function getHelp()
    {
        return <<<EOD
USAGE
  yiic event [action] [parameter]

DESCRIPTION
  This command manages Events.

ACTIONS
 * yiic event sync
   Fetches events from ical-URL and updates the Database.

 * yiic event delete
   Deletes old Events (End-Date > 2 week old) out of the Database.


EOD;
    }

    /**
     * Default action, delegates to actionFetch
     */
    public function actionIndex()
    {
        $this->actionFetch();
    }

    /**
     * Fetch data from ical-url to sync Events
     */
    public function actionFetch()
    {
    }

    /**
     * Deletes old Events (End-Date > 2 week old) out of the Database
     */
    public function actionDelete()
    {
        date_default_timezone_set('Europe/Berlin');
        $events = Events::model()->findAll('DTEND < ?', array(date(DateTime::RFC1123, strtotime('-2 weeks'))));
        $count = count($events);
        foreach($events as $event)
        {
            $event->delete();
        }
        echo 'Es wurden ' . $count . ' Events gelöscht.';
    }

}