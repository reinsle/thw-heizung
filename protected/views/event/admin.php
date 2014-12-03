<?php

$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'Zeige ' . ' ' . $model->label(2), 'url' => array('index')),
    array('label' => 'Neuer ' . ' ' . $model->label(), 'url' => array('create')),
);
?>

    <h1><?php echo 'Manage' . ' ' . GxHtml::encode($model->label(2)); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'event-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'start:datetime',
        'ende:datetime',
        'category',
        'description',
        'location',
        array(
            'class' => 'CButtonColumn',
            'header' => CHtml::dropDownList('pageSize', Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']), Yii::app()->params['pageSizeOptions'], array(
                'onchange' => "$.fn.yiiGridView.update('event-grid',{ data:{pageSize: $(this).val() }})",
            )),
        ),
    ),
)); ?>