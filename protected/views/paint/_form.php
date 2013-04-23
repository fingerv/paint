<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'paint-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation' => true,
	'htmlOptions'=>array('enctype' => 'multipart/form-data'),
	'type' => 'horizontal'
)); ?>
		<?php echo $form->errorSummary($model); ?>

		<?php echo $form->textFieldRow($model,'brand',array('class'=>'span4','maxlength'=>255)); ?>
		<div class="control-group">
			<div class="control-label">
				<?php echo $form->labelEx($model,'class'); ?>
			</div>
			<div class="controls">
				<?php echo $form->dropDownList($model,'class', $model->classes, array('class'=>'span3')); ?>
			</div>
		</div>


		<fieldset>
			<legend>Изображения краски</legend>
			<div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $form->label($model, 'C'); ?>
					</div>
					<div class="controls">
						<?php echo $form->fileField($model, 'C'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $form->label($model, 'M'); ?>
					</div>
					<div class="controls">
						<?php echo $form->fileField($model, 'M'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $form->label($model, 'Y'); ?>
					</div>
					<div class="controls">
						<?php echo $form->fileField($model, 'Y'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $form->label($model, 'K'); ?>
					</div>
					<div class="controls">
						<?php echo $form->fileField($model, 'K'); ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="span4">
					<div class="control-group">
						<div class="control-label">
							<?php echo $form->label($model,'Lc'); ?>
						</div>
						<div class="controls">
							<?php echo $form->fileField($model,'Lc'); ?>
						</div>
					</div>
					<div class="control-group">
						<div class="control-label">
							<?php echo $form->label($model,'Lm'); ?>
						</div>
						<div class="controls">
							<?php echo $form->fileField($model,'Lm'); ?>
						</div>
					</div>
					<div class="control-group">
						<div class="control-label">
							<?php echo $form->label($model,'Or'); ?>
						</div>
						<div class="controls">
							<?php echo $form->fileField($model,'Or'); ?>
						</div>
					</div>
					<div class="control-group">
						<div class="control-label">
							<?php echo $form->label($model,'Gr'); ?>
						</div>
						<div class="controls">
							<?php echo $form->fileField($model,'Gr'); ?>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="control-group">
						<div class="control-label">
							<?php echo $form->label($model,'W'); ?>
						</div>
						<div class="controls">
							<?php echo $form->fileField($model,'W'); ?>
						</div>
					</div>
					<div class="control-group">
						<div class="control-label">
							<?php echo $form->label($model,'V'); ?>
						</div>
						<div class="controls">
							<?php echo $form->fileField($model,'V'); ?>
						</div>
					</div>
					<div class="control-group">
						<div class="control-label">
							<?php echo $form->label($model,'P'); ?>
						</div>
						<div class="controls">
							<?php echo $form->fileField($model,'P'); ?>
						</div>
					</div>
					<div class="control-group">
						<div class="control-label">
							<?php echo $form->label($model,'F'); ?>
						</div>
						<div class="controls">
							<?php echo $form->fileField($model,'F'); ?>
						</div>
					</div>
				</div>
			</div>
		</fieldset>


		<div class="form-actions">
			<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
		</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
	$(function() {
		$('.colors').chosen({
		});
	});
</script>
