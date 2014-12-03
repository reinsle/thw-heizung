<?php

$this->breadcrumbs = array(
    Event::label(2),
    'Index',
);

$this->menu = array(
    array('label' => 'Neuer ' . ' ' . Event::label(), 'url' => array('create')),
    array('label' => 'Zeige ' . ' ' . Event::label(2), 'url' => array('admin')),
);

$cs = Yii::app()->clientScript;
$cs->registerCSSFile('//cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.css');
$cs->registerCSSFile('//cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.print.css');
$cs->registerScriptFile('//cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.min.js');
?>

<h1><?php echo GxHtml::encode(Event::label(2)); ?></h1>

<div id='calendar'></div>

<script>
    $(document).ready(function () {
        $('#calendar').fullCalendar({
            firstDay: 1,
            header: {
                left: 'prev,next',
                center: 'title',
                right: 'today'
            },
            events: '<?php echo CController::createUrl("event/calendarEvents"); ?>',
            monthNames: ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'],
            monthNamesShort: ['Jan', 'Feb', 'Mär', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez'],
            dayNames: ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'],
            dayNamesShort: ['Son', 'Mon', 'Die', 'Mit', 'Don', 'Fre', 'Sam'],
            buttonText: {'today': 'Heute', 'month': 'monat', 'week': 'Woche', 'day': 'Tag'},
        })
    });
</script>