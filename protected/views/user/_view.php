<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
    <?php echo CHtml::encode($data->email); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
    <?php echo CHtml::encode(date('H:i:s d.m.Y', $data->create_time)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
    <?php echo CHtml::encode(date('H:i:s d.m.Y', $data->update_time)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('last_login_time')); ?>:</b>
    <?php echo CHtml::encode(date('H:i:s d.m.Y', $data->last_login_time)); ?>
    <br/>

</div>