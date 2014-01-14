<?php

$this->breadcrumbs = array(
    History::label(2),
    'Index',
);

$this->menu = array();
?>

    <h1><?php echo GxHtml::encode(History::label(2)); ?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'history-grid',
    'dataProvider' => $dataProvider,
    'columns' => array(
        'id',
        'name',
        'tst',
        array(
            'name' => 'create_time',
            'value' => 'date("H:i d.m.Y", $data->create_time)'
        ),
        array(
            'name' => 'update_time',
            'value' => 'date("H:i d.m.Y", $data->update_time)'
        ),
    ),
)); ?>
