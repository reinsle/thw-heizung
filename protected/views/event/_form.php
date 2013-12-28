<?php
/* @var $this EventController */
/* @var $model Event */
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

function roundTime($increment, $timestamp = 0)
{
    if (!$timestamp) $timestamp = time();

    $increment = strtotime($increment, 1) - 1;
    $this_hour = strtotime(date("Y-m-d H:", strtotime("-1 Hour", $timestamp)) . "00:00");
    $next_hour = strtotime(date("Y-m-d H:", strtotime("+1 Hour", $timestamp)) . "00:00");

    $increments = array();
    $differences = array();

    for ($i = $this_hour; $i <= $next_hour; $i += $increment) {
        $increments [] = $i;
        $differences [] = ($timestamp > $i) ? $timestamp - $i : $i - $timestamp;
    }

    arsort($differences);

    $key = array_pop(array_keys($differences));

    return $increments[$key];
}

?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'event-form',
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
        <?php echo $form->textField($model, 'uid', array('size' => 60, 'maxlength' => 64, 'readonly' => true)); ?>
        <?php echo $form->error($model, 'uid'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'start'); ?>
        <?php $model->start = date("H:i d.m.Y", roundTime('30 minutes' , $model->start));
            echo $form->textField($model,'start', array('readonly' => true)); ?>
        <?php echo $form->error($model, 'start'); ?>
    </div>

    <script>
        $('#Event_start').appendDtpicker({
            'locale': 'de',
            'dateFormat': 'hh:mm DD.MM.YYYY',
            'minuteInterval': 30,
            'firstDayOfWeek': 1});
    </script>

    <div class="row">
        <?php echo $form->labelEx($model, 'end'); ?>
        <?php $model->end = date("H:i d.m.Y", roundTime('30 minutes' , $model->end));
        echo $form->textField($model,'end', array('readonly' => true)); ?>
        <?php echo $form->error($model, 'end'); ?>
    </div>

    <script>
        $('#Event_end').appendDtpicker({
            'locale': 'de',
            'dateFormat': 'hh:mm DD.MM.YYYY',
            'minuteInterval': 30,
            'firstDayOfWeek': 1});
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