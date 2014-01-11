<div class="form">


    <?php $form = $this->beginWidget('GxActiveForm', array(
        'id' => 'history-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">
        Fields with <span class="required">*</span> are required.
    </p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('maxlength' => 255)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'tst'); ?>
        <?php echo $form->textField($model, 'tst'); ?>
        <?php echo $form->error($model, 'tst'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'create_time'); ?>
        <?php echo $form->textField($model, 'create_time'); ?>
        <?php echo $form->error($model, 'create_time'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'update_time'); ?>
        <?php echo $form->textField($model, 'update_time'); ?>
        <?php echo $form->error($model, 'update_time'); ?>
    </div>
    <!-- row -->


    <?php
    echo GxHtml::submitButton('Save');
    $this->endWidget();
    ?>
</div><!-- form -->