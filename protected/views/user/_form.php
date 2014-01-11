<div class="form">


    <?php $form = $this->beginWidget('GxActiveForm', array(
        'id' => 'user-form',
        'enableAjaxValidation' => true,
    ));
    ?>

    <p class="note">
        Fields with <span class="required">*</span> are required.
    </p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('maxlength' => 128)); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->passwordField($model, 'password', array('maxlength' => 128)); ?>
        <?php echo $form->error($model, 'password'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'password_repeat'); ?>
        <?php echo $form->passwordField($model, 'password_repeat', array('maxlength' => 128)); ?>
        <?php echo $form->error($model, 'password_repeat'); ?>
    </div>
    <!-- row -->


    <?php
    echo GxHtml::submitButton('Save');
    $this->endWidget();
    ?>
</div><!-- form -->