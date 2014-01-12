<?php

$this->breadcrumbs = array(
    History::label(2),
    'Index',
);

$this->menu = array();
?>

    <h1><?php echo GxHtml::encode(History::label(2)); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
)); 