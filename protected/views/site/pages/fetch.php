<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Fetch';
$this->breadcrumbs=array(
	'Fetch',
);
?>
<h1>Aktualisierung der Event-Daten</h1>

<?php

    function icsToArray($paramUrl) {
        $icsFile = file_get_contents($paramUrl);
        $icsData = explode("BEGIN:", $icsFile);
        foreach($icsData as $key => $value) {
            $icsDatesMeta[$key] = explode("\n", $value);
        }
        foreach($icsDatesMeta as $key => $value) {
            foreach($value as $subKey => $subValue) {
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

    /*
     * Read out the data out of the input array and parse them to event-data
     *
     * $value Value-Array holding the data
     * $event Event-Object to store
     */
    function parseData($value, $event) {
        if (array_key_exists('DTSTAMP', $value)) {
            $ts = strtotime($value['DTSTAMP']);
            $event->dtstamp = date(DateTime::RFC1123, $ts);
        }
        if (array_key_exists('DTSTART', $value)) {
            $ts = strtotime($value['DTSTART']);
            $event->dtstart = date(DateTime::RFC1123, $ts);
        }
        if (array_key_exists('DTEND', $value)) {
            $ts = strtotime($value['DTEND']);
            $event->dtend = date(DateTime::RFC1123, $ts);
        }
        if (array_key_exists('SUMMARY', $value)) {
            if ($event->summary != trim($value['SUMMARY'])) {
                $event->summary = trim($value['SUMMARY']);
            }
        }
        if (array_key_exists('DESCRIPTION', $value)) {
            if ($event->description != trim($value['DESCRIPTION'])) {
                $event->description = trim($value['DESCRIPTION']);
            }
        }
        if (array_key_exists('LOCATION', $value)) {
            if ($event->location != trim($value['LOCATION'])) {
                $event->location = trim($value['LOCATION']);
            }
        }
        $event->save();
    }

    date_default_timezone_set('Europe/Berlin');
    $url='http://ov-kempten.ov-cms.thw.de/unser-thw-ortsverband/terminkalender/kalender/ics/?type=150&tx_cal_controller%5Bcalendar%5D=20';
    $temp = tempnam('/tmp', 'thw-kempten');
    file_put_contents($temp, file_get_contents($url));
    $data = icsTOArray($temp);
    $insert = 0;
    $update = 0;
    foreach ($data as &$value) {
        if ($value['BEGIN'] == 'VEVENT' && array_key_exists('DTEND', $value)) {
            $dtend = strtotime($value['DTEND']);
            $weeks = strtotime('-1 week');
            if ($dtend > $weeks) {
                $criteria = new CDbCriteria;
                $criteria->condition = "uid = '".trim($value['UID'])."'";
                $models = Events::model()->findAll($criteria);
                if (count($models) > 0) {
                    // Update Date to Events model
                    $event = $models[0];
                    parseData($value, $event);
                    $update++;
                } else {
                    // Create new Events model from data
                    $event = new Events();
                    $event->uid = trim($value['UID']);
                    parseData($value, $event);
                    $insert++;
                }
            }
        }
    }
    unlink($temp);
    unset($url);
    unset($temp);
    unset($data);
    echo '<p>es wurden ' . $insert . ' neue Datensaetze angelegt, und ' . $update . ' Datensaetze aktualisiert.</p>';
?>