<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('brand')); ?>:</b>
	<?php echo CHtml::encode($data->brand); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('model')); ?>:</b>
	<?php echo CHtml::encode($data->model); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('class')); ?>:</b>
    <?php echo CHtml::encode($data->class); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('heads')); ?>:</b>
    <?php echo CHtml::encode($data->heads); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('scheme')); ?>:</b>
	<?php echo CHtml::encode($data->scheme); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('logo')); ?>:</b>
	<?php echo CHtml::encode($data->logo); ?>
	<br />


</div>