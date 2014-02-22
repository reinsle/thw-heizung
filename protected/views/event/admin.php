<?php

$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'Zeige ' . ' ' . $model->label(2), 'url' => array('index')),
    array('label' => 'Neuer ' . ' ' . $model->label(), 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('event-grid', {
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
    'id' => 'event-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'uid',
        'start',
        'ende',
        'category',
        'summary',
        'description',
        /*
        'location',
        'create_time',
        'update_time',
        array(
                    'name' => 'active',
                    'value' => '($data->active === 0) ? \'No\' : \'Yes\'',
                    'filter' => array('0' => 'No', '1' => 'Yes'),
                    ),
        */
        array(
            'class' => 'CButtonColumn',
        ),
    ),
)); ?>