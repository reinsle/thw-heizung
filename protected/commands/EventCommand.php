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

 * yiic event cleanUp
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
        date_default_timezone_set('Europe/Berlin');
        $newEvents = $this->icsToArray(Yii::app()->params['ICAL_URL']);
        $insert = 0;
        $update = 0;
        foreach ($newEvents as &$newEvent) {
            if ($newEvent['BEGIN'] == 'VEVENT' && array_key_exists('DTEND', $newEvent)) {
                $dtend = strtotime($newEvent['DTEND']);
                $weeks = strtotime('-2 weeks');
                if ($dtend > $weeks) {
                    $criteria = new CDbCriteria;
                    $criteria->condition = "uid = '" . trim($newEvent['UID']) . "'";
                    $models = Event::model()->findAll($criteria);
                    if (count($models) > 0) {
                        // Update Date to Events model
                        $event = $models[0];
                        $this->parseData($newEvent, $event);
                        $update++;
                    } else {
                        // Create new Events model from data
                        $event = new Event();
                        $event->uid = trim($newEvent['UID']);
                        $this->parseData($newEvent, $event);
                        $insert++;
                    }
                }
            }
        }
        echo 'es wurden ' . $insert . ' neue Datensätze angelegt, und ' . $update . " Datensätze aktualisiert.\r\n";
    }

    /**
     * Deletes old Events (End-Date > 2 week old) out of the Database
     */
    public function actionCleanUp()
    {
        date_default_timezone_set('Europe/Berlin');
        $events = Event::model()->findAll('ende < ?', array(strtotime('-2 weeks')));
        $count = count($events);
        foreach ($events as $event) {
            $event->delete();
        }
        echo 'Es wurden ' . $count . " Events gelöscht.\r\n";
    }

    /**
     * Fetches Content of paramUrl and split them to single calendar elements
     *
     * @param $paramUrl the url to fetch data from
     * @return mixed Calendar Events
     */
    function icsToArray($paramUrl)
    {
        $icsFile = file_get_contents($paramUrl);
        $icsData = explode("BEGIN:", $icsFile);
        foreach ($icsData as $key => $value) {
            $icsDatesMeta[$key] = explode("\n", $value);
        }
        foreach ($icsDatesMeta as $key => $value) {
            foreach ($value as $subKey => $subValue) {
                if ($subValue != "") {
                    if ($key != 0 && $subKey == 0) {
                        $icsDates[$key]["BEGIN"] = $subValue;
                    } else {
                        $subValueArr = explode(":", $subValue, 2);
                        $icsDates[$key][$subValueArr[0]] = $subValueArr[1];
                    }
                }
            }
        }
        return $icsDates;
    }

    /**
     * Read out the data out of the input array and parse them to event-data
     *
     * $value Value-Array holding the data
     * $event Event-Object to store
     */
    function parseData($newEvent, $event)
    {
        if (array_key_exists('DTSTAMP', $newEvent)) {
            $ts = strtotime($newEvent['DTSTAMP']);
            $event->create_time = $ts;
            $event->update_time = $ts;
        }
        if (array_key_exists('DTSTART', $newEvent)) {
            $event->start = strtotime($newEvent['DTSTART']);
        }
        if (array_key_exists('DTEND', $newEvent)) {
            $event->ende = strtotime($newEvent['DTEND']);
        }
        if (array_key_exists('CATEGORIES', $newEvent)) {
            if ($event->category != trim($newEvent['CATEGORIES'])) {
                $event->category = trim($newEvent['CATEGORIES']);
            }
        }
        if (array_key_exists('SUMMARY', $newEvent)) {
            if ($event->summary != trim($newEvent['SUMMARY'])) {
                $event->summary = trim($newEvent['SUMMARY']);
            }
        }
        if (array_key_exists('DESCRIPTION', $newEvent)) {
            if ($event->description != trim($newEvent['DESCRIPTION'])) {
                $event->description = trim($newEvent['DESCRIPTION']);
            }
        }
        if (array_key_exists('LOCATION', $newEvent)) {
            if ($event->location != trim($newEvent['LOCATION'])) {
                $event->location = trim($newEvent['LOCATION']);
            }
        }
        $event->save();
    }

}