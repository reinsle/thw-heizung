<?php
$this->breadcrumbs = array(
	History::label(2),
	'Index',
);
?>

<h1><?php echo GxHtml::encode(History::label(2)); ?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'history-grid',
    'dataProvider' => $model->search(),
    'columns' => array(
        'id',
        'name',
        'tst',
        'create_time',
        'update_time',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));