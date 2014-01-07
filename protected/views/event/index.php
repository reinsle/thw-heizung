<?php
/* @var $this EventController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Events',
);

$this->menu = array(
    array('label' => 'Create Event', 'url' => array('create')),
    array('label' => 'Manage Event', 'url' => array('admin')),
);
?>

<h1>Events</h1>

<?php
$this->widget('ext.EFullCalendar.EFullCalendar', array(
    'themeCssFile' => 'cupertino/jquery-ui.min.css',
    'lang' => 'de',
    'options' => array(
        'header' => array(
            'left' => 'prev,next',
            'center' => 'title',
            'right' => 'today'
        ),
        'events' => CController::createUrl("event/calendarEvents"),
    )
));
?>
