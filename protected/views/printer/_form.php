<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'printer-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation' => true,
	'clientOptions' => array(
		'validateOnSubmit' => true,
	),
	'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'brand',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'model',array('class'=>'span5','maxlength'=>255)); ?>
	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model, 'schemeSelection'); ?>
			<div>
				<?php echo $form->radioButtonList($model, 'schemeSelection', $model->supportedSchemes); ?>
			</div>
			<div>
				<?php echo $form->checkBoxList($model, 'colorSelection', $model->additionalColors, array('uncheckValue' => null)); ?>
			</div>
		</div>
		<div class="span5">
			<?php echo $form->label($model,'logo'); ?>
			<?php echo $form->fileField($model,'logo', array('class'=>'span5')); ?>

			<?php if(!$model->isNewRecord): ?>
			<div>
				<?php $src = empty($model->logo) ? '//placehold.it/300x200' : Yii::app()->baseUrl . '/uploads/' . $model->logo; ?>
				<img src="<?php echo $src; ?>" class="img-rounded"/>
			</div>
			<?php endif; ?>
		</div>
	</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
