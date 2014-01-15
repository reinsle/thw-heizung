<?php
/* @var $this EventController */
/* @var $model Event */

$this->breadcrumbs = array(
    'Dienste' => array('index'),
    $model->uid => array('view', 'id' => $model->uid),
    'Bearb.',
);

$this->menu = array(
    array('label' => 'Terminkalender', 'url' => array('index')),
    array('label' => 'Neuer Dienst', 'url' => array('create')),
    array('label' => 'Zeige Dienst', 'url' => array('view', 'id' => $model->uid)),
    array('label' => 'Bearb. Dienste', 'url' => array('admin')),
);
?>

    <h1><?php echo $model->uid; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>