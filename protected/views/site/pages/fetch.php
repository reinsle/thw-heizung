<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Fetch';
$this->breadcrumbs=array(
	'Fetch',
);
?>
<h1>Fetch</h1>


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

    $url='http://ov-kempten.ov-cms.thw.de/unser-thw-ortsverband/terminkalender/kalender/ics/?type=150&tx_cal_controller%5Bcalendar%5D=20';
    $temp = tempnam('/tmp', 'thw-kempten');
    file_put_contents($temp, file_get_contents($url));
    $data = icsTOArray($temp);
    foreach ($data as &$value) {
        if ($value['BEGIN'] == 'VEVENT') {
            $criteria = new CDbCriteria;
            $criteria->condition = "uid = '".trim($value['UID'])."'";
            $models = Events::model()->findAll($criteria);
            if (count($models) > 0) {
                // Update Date to Events model
                $event = $models[0];

                if (array_key_exists('SUMMARY', $value)) {
                    $event->summary = trim($value['SUMMARY']);
                }
                if (array_key_exists('DESCRIPTION', $value)) {
                    $event->description = trim($value['DESCRIPTION']);
                }
                if (array_key_exists('LOCATION', $value)) {
                    $event->location = trim($value['LOCATION']);
                }
                $event->save();
            } else {
                // Create new Events model from data
                $event = new Events();
                $event->uid = trim($value['UID']);

                if (array_key_exists('SUMMARY', $value)) {
                    $event->summary = trim($value['SUMMARY']);
                }
                if (array_key_exists('DESCRIPTION', $value)) {
                    $event->description = trim($value['DESCRIPTION']);
                }
                if (array_key_exists('LOCATION', $value)) {
                    $event->location = trim($value['LOCATION']);
                }
                $event->save();
            }
            echo 'laber <br />';
        }
    }
    unlink($temp);
    unset($url);
    unset($temp);
    unset($data);
?>
<p>This is a "static" page. You may change the content of this page
by updating the file <code><?php echo __FILE__; ?></code>.</p>
