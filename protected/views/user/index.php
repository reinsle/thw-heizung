<?php

$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List' . ' ' . $model->label(2), 'url' => array('index')),
    array('label' => 'Create' . ' ' . $model->label(), 'url' => array('create')),
);
?>

    <h1><?php echo 'Manage' . ' ' . GxHtml::encode($model->label(2)); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'user-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'email',
        'create_time:datetime',
        'update_time:datetime',
        'last_login_time:datetime',
        array(
            'class' => 'CButtonColumn',
            'header' => CHtml::dropDownList('pageSize', Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']), Yii::app()->params['pageSizeOptions'], array(
                'onchange' => "$.fn.yiiGridView.update('history-grid',{ data:{pageSize: $(this).val() }})",
            )),
        ),
    ),
)); ?>