<div class="wide form">

    <?php $form = $this->beginWidget('GxActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>

    <div class="row">
        <?php echo $form->label($model, 'uid'); ?>
        <?php echo $form->textField($model, 'uid', array('maxlength' => 64)); ?>
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
        <?php echo $form->textField($model, 'category', array('maxlength' => 64)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'summary'); ?>
        <?php echo $form->textField($model, 'summary', array('maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'location'); ?>
        <?php echo $form->textField($model, 'location', array('maxlength' => 64)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'create_time'); ?>
        <?php echo $form->textField($model, 'create_time'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'update_time'); ?>
        <?php echo $form->textField($model, 'update_time'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'active'); ?>
        <?php echo $form->dropDownList($model, 'active', array('0' => 'No', '1' => 'Yes'), array('prompt' => 'All')); ?>
    </div>

    <div class="row buttons">
        <?php echo GxHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
