<?php

$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    GxHtml::valueEx($model),
);

$this->menu = array(
    array('label' => 'Dienstkalender', 'url' => array('index')),
    array('label' => 'Neuer ' . ' ' . $model->label(), 'url' => array('create')),
    array('label' => 'Bearbeite ' . ' ' . $model->label(), 'url' => array('update', 'id' => $model->uid)),
    array('label' => 'Lösche ' . ' ' . $model->label(), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->uid), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Zeige ' . ' ' . $model->label(2), 'url' => array('admin')),
);
?>

<h1><?php echo 'View' . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'uid',
        'start',
        'ende',
        'category',
        'summary',
        'description',
        'location',
        'create_time',
        'update_time',
        'active:boolean',
    ),
)); ?>

