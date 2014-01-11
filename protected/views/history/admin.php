<?php

$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List' . ' ' . $model->label(2), 'url' => array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('history-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

    <h1><?php echo 'Manage' . ' ' . GxHtml::encode($model->label(2)); ?></h1>

    <p>
        You may optionally enter a comparison operator (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of
        each of your search values to specify how the comparison should be done.
    </p>

<?php echo GxHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
    <div class="search-form">
        <?php $this->renderPartial('_search', array(
            'model' => $model,
        )); ?>
    </div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'history-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
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
)); ?>