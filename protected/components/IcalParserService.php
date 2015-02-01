<?php

class IcalParserService
{

    public static function parseICalEvent($iCalEvent)
    {
        if (array_key_exists("VEVENT", $iCalEvent)) {
            $event = new Event();
            IcalParserService::parseICalData($iCalEvent, $event);
        }
    }

    private static function parseICalData($newEvent)
    {
        if (array_key_exists('RRULE', $newEvent)) {
            $data = IcalParserService::doubleExplode(';', '=', $newEvent['RRULE']);
            $startDate = strtotime($newEvent['DTSTART']);
            $endDate = strtotime($newEvent['DTEND']);
            $until = strtotime($data['UNTIL']);
            $timeDiff = '+' . $data['INTERVAL'] . ' ';
            $uid = $newEvent['UID'];
            $count = 1;
            if ($data['FREQ'] == 'WEEKLY') {
                $timeDiff .= 'week';
            } else {
                throw new Exception('Frequency ' . $data['FREQ'] . 'unknown!');
            }
            do {
                if ($endDate >= strtotime('- 2 weeks')) {
                    $uuid = $uid . '_' . $count;
                    $event = Event::model()->findByPk($uuid);
                    if (empty($event)) {
                        $event = new Event();
                    }
                    $event = IcalParserService::convertSingleElement($newEvent, null, $uid . '_' . $count, $startDate, $endDate);
                    if (!$event->save()) {
                        var_dump($event->getErrors());
                    }
                }
                $startDate = strtotime($timeDiff, $startDate);
                $endDate = strtotime($timeDiff, $endDate);
                $count++;
            } while ($startDate <= ($until + (22 * 60 * 60)));
        } else {
            $event = Event::model()->findByPk($newEvent['UID']);
            if (empty($event)) {
                $event = new Event();
            }
            $event = IcalParserService::convertSingleElement($newEvent, $event);
            if (!$event->save()) {
                var_dump($event->getErrors());
            }
        }
        return;
    }

    private static function convertSingleElement($iCalData, $event = null, $uid = null, $dtStart = null, $dtEnd = null)
    {
        if (empty($event)) {
            $event = new Event();
        }
        if (!empty($uid)) {
            $event->uid = $uid;
        } elseif (array_key_exists('UID', $iCalData)) {
            $event->uid = $iCalData['UID'];
        }
        if (array_key_exists('DTSTAMP', $iCalData)) {
            $ts = strtotime($iCalData['DTSTAMP']);
            $event->create_time = $ts;
            $event->update_time = $ts;
        }
        if (!is_null($dtStart)) {
            $event->start = $dtStart;
        } else if (array_key_exists('DTSTART', $iCalData)) {
            $event->start = strtotime($iCalData['DTSTART']);
        }
        if (!is_null($dtEnd)) {
            $event->ende = $dtEnd;
        } else if (array_key_exists('DTEND', $iCalData)) {
            $event->ende = strtotime($iCalData['DTEND']);
        }
        if (array_key_exists('CATEGORIES', $iCalData)) {
            if ($event->category != trim($iCalData['CATEGORIES'])) {
                $event->category = trim($iCalData['CATEGORIES']);
            }
        }
        if (array_key_exists('SUMMARY', $iCalData)) {
            if ($event->summary != trim($iCalData['SUMMARY'])) {
                $event->summary = trim($iCalData['SUMMARY']);
            }
        }
        if (array_key_exists('DESCRIPTION', $iCalData)) {
            if ($event->description != trim($iCalData['DESCRIPTION'])) {
                $event->description = trim($iCalData['DESCRIPTION']);
            }
        }
        if (array_key_exists('LOCATION', $iCalData)) {
            if ($event->location != trim($iCalData['LOCATION'])) {
                $event->location = trim($iCalData['LOCATION']);
            }
        }
        return $event;
    }

    public static function doubleExplode($del1, $del2, $string)
    {
        $result = array();
        foreach (explode($del1, $string) as $val1) {
            $val2 = explode($del2, $val1);
            if (count($val2) == 1) {
                $result[$val2[0]] = null;
            } elseif (count($val2) == 2) {
                $result[$val2[0]] = $val2[1];
            }
        }
        return $result;
    }
}