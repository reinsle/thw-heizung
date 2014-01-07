<?php
/* @var $this EventController */
/* @var $model Event */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>

    <div class="row">
        <?php echo $form->label($model, 'uid'); ?>
        <?php echo $form->textField($model, 'uid', array('size' => 60, 'maxlength' => 64)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'start'); ?>
        <?php echo $form->textField($model, 'start'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'ende'); ?>
        <?php echo $form->textField($model, 'ende'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'category'); ?>
        <?php echo $form->textField($model, 'category', array('size' => 60, 'maxlength' => 64)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'summary'); ?>
        <?php echo $form->textField($model, 'summary', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'location'); ?>
        <?php echo $form->textField($model, 'location', array('size' => 60, 'maxlength' => 64)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->