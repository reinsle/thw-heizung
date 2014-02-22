<div class="view">

    <?php echo GxHtml::encode($data->getAttributeLabel('uid')); ?>:
    <?php echo GxHtml::link(GxHtml::encode($data->uid), array('view', 'id' => $data->uid)); ?>
    <br/>

    <?php echo GxHtml::encode($data->getAttributeLabel('start')); ?>:
    <?php echo GxHtml::encode($data->start); ?>
    <br/>
    <?php echo GxHtml::encode($data->getAttributeLabel('ende')); ?>:
    <?php echo GxHtml::encode($data->ende); ?>
    <br/>
    <?php echo GxHtml::encode($data->getAttributeLabel('category')); ?>:
    <?php echo GxHtml::encode($data->category); ?>
    <br/>
    <?php echo GxHtml::encode($data->getAttributeLabel('summary')); ?>:
    <?php echo GxHtml::encode($data->summary); ?>
    <br/>
    <?php echo GxHtml::encode($data->getAttributeLabel('description')); ?>:
    <?php echo GxHtml::encode($data->description); ?>
    <br/>
    <?php echo GxHtml::encode($data->getAttributeLabel('location')); ?>:
    <?php echo GxHtml::encode($data->location); ?>
    <br/>
    <?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('create_time')); ?>:
	<?php echo GxHtml::encode($data->create_time); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('update_time')); ?>:
	<?php echo GxHtml::encode($data->update_time); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('active')); ?>:
	<?php echo GxHtml::encode($data->active); ?>
	<br />
	*/
    ?>

</div>