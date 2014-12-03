<?php
$this->breadcrumbs = array(
    History::label(2),
    'Index',
);
?>

    <h1><?php echo GxHtml::encode(History::label(2)); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'history-grid',
    'dataProvider' => $model->search(),
    'columns' => array(
        'id',
        'name',
        'tst',
        'create_time:datetime',
        'update_time:datetime',
        array(
            'class' => 'CButtonColumn',
            'header' => CHtml::dropDownList('pageSize', Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']), Yii::app()->params['pageSizeOptions'], array(
                'onchange' => "$.fn.yiiGridView.update('history-grid',{ data:{pageSize: $(this).val() }})",
            )),
        ),
    ),
));