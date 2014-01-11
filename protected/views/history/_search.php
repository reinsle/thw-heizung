<div class="wide form">

    <?php $form = $this->beginWidget('GxActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>

    <div class="row">
        <?php echo $form->label($model, 'id'); ?>
        <?php echo $form->textField($model, 'id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'tst'); ?>
        <?php echo $form->textField($model, 'tst'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'create_time'); ?>
        <?php echo $form->textField($model, 'create_time'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'update_time'); ?>
        <?php echo $form->textField($model, 'update_time'); ?>
    </div>

    <div class="row buttons">
        <?php echo GxHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
