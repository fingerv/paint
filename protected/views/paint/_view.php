<?php
$this->menu=array(
	array('label'=>'Список красок','url'=>array('index')),
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Редактировать','url'=>array('update','id'=>$model->id)),
	array('label'=>'Удалить','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>
<div class="view">
	<div class="row">
		<div class="span3 offset2">
			<b><?php echo CHtml::encode($model->getAttributeLabel('id')); ?>:</b>
			<?php echo CHtml::link(CHtml::encode($model->id),array('view','id'=>$model->id)); ?>
			<br />

			<b><?php echo CHtml::encode($model->getAttributeLabel('brand')); ?>:</b>
			<?php echo CHtml::encode($model->brand); ?>
			<br />

			<b><?php echo CHtml::encode($model->getAttributeLabel('class')); ?>:</b>
			<?php echo CHtml::encode($model->class); ?>
		</div>
		<div class="span4">
			<?php if($model->getAvailableColorImagesCount() != 0): ?>
				<h4>Изображения красок</h4>
				<?php foreach($model->colors as $color): ?>
				<?php if($model->hasAttribute($color) && !empty($model->$color)): ?>
					<div><?php echo $color; ?></div>
					<div>
						<img src="<?php echo Yii::app()->baseUrl . '/uploads/' . $model->$color ?>" height="100" width="100" />
					</div>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>

</div>