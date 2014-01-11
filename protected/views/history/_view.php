<div class="view">

    <?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
    <?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br/>

    <?php echo GxHtml::encode($data->getAttributeLabel('name')); ?>:
    <?php echo GxHtml::encode($data->name); ?>
    <br/>
    <?php echo GxHtml::encode($data->getAttributeLabel('tst')); ?>:
    <?php echo GxHtml::encode($data->tst); ?>
    <br/>
    <?php echo GxHtml::encode($data->getAttributeLabel('create_time')); ?>:
    <?php echo GxHtml::encode(date('H:i d.m.Y', $data->create_time)); ?>
    <br/>
    <?php echo GxHtml::encode($data->getAttributeLabel('update_time')); ?>:
    <?php echo GxHtml::encode(date('H:i d.m.Y', $data->update_time)); ?>
    <br/>

</div>