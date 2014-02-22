<?php

$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    GxHtml::valueEx($model) => array('view', 'id' => GxActiveRecord::extractPkValue($model, true)),
    'Update',
);

$this->menu = array(
    array('label' => 'Dienstkalender', 'url' => array('index')),
    array('label' => 'Neuer ' . ' ' . $model->label(), 'url' => array('create')),
    array('label' => 'Zeige ' . ' ' . $model->label(), 'url' => array('view', 'id' => GxActiveRecord::extractPkValue($model, true))),
    array('label' => 'Zeige ' . ' ' . $model->label(2), 'url' => array('admin')),
);
?>

    <h1><?php echo 'Update' . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php
$this->renderPartial('_form', array(
    'model' => $model));
?>