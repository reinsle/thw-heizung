<?php
/* @var $this EventController */
/* @var $model Event */

$this->breadcrumbs = array(
    'Dienste' => array('index'),
    $model->uid,
);

$this->menu = array(
    array('label' => 'Terminkalender', 'url' => array('index')),
    array('label' => 'Neuer Dienst', 'url' => array('create')),
    array('label' => 'Dienst bearb.', 'url' => array('update', 'id' => $model->uid)),
    array('label' => 'Dienst löschen', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->uid), 'confirm' => 'Soll der Dienst gelöscht werden?')),
    array('label' => 'Bearb. Dienste', 'url' => array('admin')),
);
?>

<h1>View Event #<?php echo $model->uid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'uid',
        array(
            'name' => 'start',
            'value' => Yii::app()->dateFormatter->format('HH:mm d.M.y', $model->start),
        ),
        array(
            'name' => 'ende',
            'value' => Yii::app()->dateFormatter->format('HH:mm d.M.y', $model->ende),
        ),
        'category',
        'summary',
        'description',
        'location',
    ),
)); ?>
