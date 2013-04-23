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

        <?php echo $form->textAreaRow($model,'description',array('class'=>'span5', 'rows' => 5)); ?>

		<fieldset>
			<legend>Изображения краски</legend>
			<div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $form->label($model, 'C'); ?>
					</div>
					<div class="controls">
						<?php echo $form->fileField($model, 'C'); ?>
                    <?php if(!$model->isNewRecord && !empty($model->C)): ?>
                        <img src="<?php echo Yii::app()->baseUrl . '/uploads/' . $model->C ?>" class="img-rounded"/>
                    <?php endif; ?>
                    </div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $form->label($model, 'M'); ?>
					</div>
					<div class="controls">
						<?php echo $form->fileField($model, 'M'); ?>
                        <?php if(!$model->isNewRecord && !empty($model->M)): ?>
                            <img src="<?php echo Yii::app()->baseUrl . '/uploads/' . $model->M ?>" class="img-rounded"/>
                        <?php endif; ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $form->label($model, 'Y'); ?>
					</div>
					<div class="controls">
						<?php echo $form->fileField($model, 'Y'); ?>
                        <?php if(!$model->isNewRecord && !empty($model->Y)): ?>
                            <img src="<?php echo Yii::app()->baseUrl . '/uploads/' . $model->Y ?>" class="img-rounded"/>
                        <?php endif; ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $form->label($model, 'K'); ?>
					</div>
					<div class="controls">
						<?php echo $form->fileField($model, 'K'); ?>
                        <?php if(!$model->isNewRecord && !empty($model->K)): ?>
                            <img src="<?php echo Yii::app()->baseUrl . '/uploads/' . $model->K ?>" class="img-rounded"/>
                        <?php endif; ?>
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
                            <?php if(!$model->isNewRecord && !empty($model->Lc)): ?>
                                <img src="<?php echo Yii::app()->baseUrl . '/uploads/' . $model->Lc ?>" class="img-rounded"/>
                            <?php endif; ?>
						</div>
					</div>
					<div class="control-group">
						<div class="control-label">
							<?php echo $form->label($model,'Lm'); ?>
						</div>
						<div class="controls">
							<?php echo $form->fileField($model,'Lm'); ?>
                            <?php if(!$model->isNewRecord && !empty($model->Lm)): ?>
                                <img src="<?php echo Yii::app()->baseUrl . '/uploads/' . $model->Lm ?>" class="img-rounded"/>
                            <?php endif; ?>
						</div>
					</div>
					<div class="control-group">
						<div class="control-label">
							<?php echo $form->label($model,'Or'); ?>
						</div>
						<div class="controls">
							<?php echo $form->fileField($model,'Or'); ?>
                            <?php if(!$model->isNewRecord && !empty($model->Or)): ?>
                                <img src="<?php echo Yii::app()->baseUrl . '/uploads/' . $model->Or ?>" class="img-rounded"/>
                            <?php endif; ?>
						</div>
					</div>
					<div class="control-group">
						<div class="control-label">
							<?php echo $form->label($model,'Gr'); ?>
						</div>
						<div class="controls">
							<?php echo $form->fileField($model,'Gr'); ?>
                            <?php if(!$model->isNewRecord && !empty($model->Gr)): ?>
                                <img src="<?php echo Yii::app()->baseUrl . '/uploads/' . $model->Gr ?>" class="img-rounded"/>
                            <?php endif; ?>
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
                            <?php if(!$model->isNewRecord && !empty($model->W)): ?>
                                <img src="<?php echo Yii::app()->baseUrl . '/uploads/' . $model->W ?>" class="img-rounded"/>
                            <?php endif; ?>
						</div>
					</div>
					<div class="control-group">
						<div class="control-label">
							<?php echo $form->label($model,'V'); ?>
						</div>
						<div class="controls">
							<?php echo $form->fileField($model,'V'); ?>
                            <?php if(!$model->isNewRecord && !empty($model->V)): ?>
                                <img src="<?php echo Yii::app()->baseUrl . '/uploads/' . $model->V ?>" class="img-rounded"/>
                            <?php endif; ?>
						</div>
					</div>
					<div class="control-group">
						<div class="control-label">
							<?php echo $form->label($model,'P'); ?>
						</div>
						<div class="controls">
							<?php echo $form->fileField($model,'P'); ?>
                            <?php if(!$model->isNewRecord && !empty($model->P)): ?>
                                <img src="<?php echo Yii::app()->baseUrl . '/uploads/' . $model->P ?>" class="img-rounded"/>
                            <?php endif; ?>
						</div>
					</div>
					<div class="control-group">
						<div class="control-label">
							<?php echo $form->label($model,'F'); ?>
						</div>
						<div class="controls">
							<?php echo $form->fileField($model,'F'); ?>
                            <?php if(!$model->isNewRecord && !empty($model->F)): ?>
                                <img src="<?php echo Yii::app()->baseUrl . '/uploads/' . $model->F ?>" class="img-rounded"/>
                            <?php endif; ?>
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
