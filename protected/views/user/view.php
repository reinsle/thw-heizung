<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Users' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List User', 'url' => array('index')),
    array('label' => 'Create User', 'url' => array('create')),
    array('label' => 'Update User', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete User', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage User', 'url' => array('admin')),
);
?>

<h1>View User #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'email',
        array(
            'name' => 'create_time',
            'value' => Yii::app()->dateFormatter->format('H:m:s d.M.y',$model->create_time),
        ),
        array(
            'name' => 'update_time',
            'value' => Yii::app()->dateFormatter->format('H:m:s d.M.y',$model->update_time),
        ),
        array(
            'name' => 'last_login_time',
            'value' => Yii::app()->dateFormatter->format('H:m:s d.M.y',$model->last_login_time),
        ),
    ),
)); ?>
