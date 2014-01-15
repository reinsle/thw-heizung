<?php
/* @var $this EventController */
/* @var $model Event */

$this->breadcrumbs = array(
    'Dienste' => array('index'),
    'Neu',
);

$this->menu = array(
    array('label' => 'Dienstkalender', 'url' => array('index')),
    array('label' => 'Bearb. Dienste', 'url' => array('admin')),
);
?>

    <h1>Neuer Dienst</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>