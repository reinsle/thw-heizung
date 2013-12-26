<?php
/* @var $this EventsController */
/* @var $model Events */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerCoreScript('jquery.ui');

$cs = Yii::app()->getClientScript();
$js_file = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'jquery.simple-dtpicker.js';
$js_url = Yii::app()->getAssetManager()->publish($js_file);
$cs->registerScriptFile($js_url);
$file = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'jquery.simple-dtpicker.css';
$url = Yii::app()->getAssetManager()->publish($file);
$cs->registerCssFile($url);
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'events-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'uid'); ?>
        <?php echo $form->textField($model, 'uid', array('size' => 60, 'maxlength' => 64)); ?>
        <?php echo $form->error($model, 'uid'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'dtstamp'); ?>
        <?php echo $form->textField($model, 'dtstamp'); ?>
        <?php echo $form->error($model, 'dtstamp'); ?>
    </div>

    <script type="text/javascript">
        $(function () {
            $('#Events_dtstamp').appendDtpicker();
        });
    </script>

    <div class="row">
        <?php echo $form->labelEx($model, 'dtstart'); ?>
        <?php echo $form->textField($model, 'dtstart'); ?>
        <?php echo $form->error($model, 'dtstart'); ?>
    </div>

    <script type="text/javascript">
        $(function () {
            $('#Events_dtstart').appendDtpicker();
        });
    </script>

    <div class="row">
        <?php echo $form->labelEx($model, 'dtend'); ?>
        <?php echo $form->textField($model, 'dtend'); ?>
        <?php echo $form->error($model, 'dtend'); ?>
    </div>

    <script type="text/javascript">
        $(function () {
            $('#Events_dtend').appendDtpicker();
        });
    </script>

    <div class="row">
        <?php echo $form->labelEx($model, 'category'); ?>
        <?php echo $form->textField($model, 'category', array('size' => 60, 'maxlength' => 64)); ?>
        <?php echo $form->error($model, 'category'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'summary'); ?>
        <?php echo $form->textField($model, 'summary', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'summary'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'location'); ?>
        <?php echo $form->textField($model, 'location', array('size' => 60, 'maxlength' => 64)); ?>
        <?php echo $form->error($model, 'location'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->