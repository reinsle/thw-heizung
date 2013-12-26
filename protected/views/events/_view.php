<?php
/* @var $this EventsController */
/* @var $data Events */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->uid), array('view', 'id'=>$data->uid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dtstamp')); ?>:</b>
	<?php echo CHtml::encode($data->dtstamp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dtstart')); ?>:</b>
	<?php echo CHtml::encode($data->dtstart); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dtend')); ?>:</b>
	<?php echo CHtml::encode($data->dtend); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category')); ?>:</b>
	<?php echo CHtml::encode($data->category); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('summary')); ?>:</b>
	<?php echo CHtml::encode($data->summary); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('location')); ?>:</b>
	<?php echo CHtml::encode($data->location); ?>
	<br />

	*/ ?>

</div>