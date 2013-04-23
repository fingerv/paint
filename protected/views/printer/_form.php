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

    <div class="control-group">
        <div class="control-label">
            <?php echo $form->labelEx($model,'class'); ?>
        </div>
        <div class="controls">
            <?php echo $form->dropDownList($model,'class', $model->classes, array('class'=>'span3')); ?>
        </div>
    </div>

    <div>
        <?php echo $form->labelEx($model, 'heads'); ?>
        <div style="float: left; margin-right: 5px; position: relative;">
            <input type="text" id="head-brand-input" placeholder="Бренд головки" data-for="head-brand" style="font-size:1.1em; color:#333; border:solid 1px #CCC; padding:4px 6px; z-index:-1; background:transparent;"/>
            <input type="text" class="suggestions" style="position: absolute; font-size: 1.1em; top:0; left:0; borderColor: transparent; padding:4px 6px; color:#CCC; z-index:-10;"/>
        </div>
        <div style="float: left; margin-right: 5px; position: relative;">
            <input type="text" id="head-model-input" placeholder="Модель головки" data-for="head-model" style="font-size:1.1em; color:#333; border:solid 1px #CCC; padding:4px 6px; z-index:-1; background:transparent;"/>
            <input type="text" class="suggestions" style="position: absolute; font-size: 1.1em; top:0; left:0; borderColor: transparent; padding:4px 6px; color:#CCC; z-index:-10;"/>
        </div>
        <input type="button" id="head-add-button" value="+" />
        <div id="heads" style="clear: both;">
            <?php foreach($model->heads as $head) : ?>
                <div id="head_id_<?php echo $head->id ?>">
                    <input type="button" value="x" onclick="headRemove(<?php echo $head->id ?>);" />
                    <?php echo $head->brand . " / " . $head->model ?>
                    <input type="hidden" name="Printer[headIds][]" value="<?php echo $head->id ?>" />
                </div>
            <?php endforeach; ?>
        </div>
    </div><br />
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<script>
    function headRemove(id){
        $('#head_id_'+id).remove();
    }

    $(document).ready(function (){
        var headId = 0;
        $('#head-brand-input').autocomplete({
            delay:100,
            minLength:1,
            source:function (request, response) {
                var $el = this.element.parent().children('.suggestions');
                $.getJSON(
                    '../../site/headBrandSearch', { term: request.term },
                    function (data) {
                        if(data && data.length == 1) {
                            $el.val(data[0].suggestion);
                        }
                    }
                );
            }
        });

        $('#head-model-input').autocomplete({
            autoFocus:true,
            delay:100,
            minLength:1,
            source:function (request, response) {
                var url, brand, item;
                var $el = this.element.parent().children('.suggestions');
                brand = $('#head-brand-input').val();
                if(!brand) {
                    alert('Сначала нужно выбрать бренд');
                    return false;
                }
                $.getJSON(
                    '../../site/headModelSearch',
                    { brand: brand, term: request.term },
                    function (data) {
                        if(data && data.length == 1) {
                            $el.val(data[0].suggestion);
                            headId = data[0].id
                        }
                    }
                );
            }
        });

        var keyDownHandler = function (event) {
            if (event.keyCode === $.ui.keyCode.TAB || event.keyCode == 39) {
                event.preventDefault();
                var $this = $(this);
                var $el = $this.parent().children('.suggestions');
                $this.val($el.val());
                    if($this.is('#head-model-input'))
                        $('#head-add-button').focus();
                    else if($this.is('#head-brand-input'))
                        $('#head-model-input').focus();

            }
        }

        $('#head-brand-input').bind('keydown', keyDownHandler);
        $('#head-model-input').bind('keydown', keyDownHandler);
        $('#head-add-button').click(function (){
            if($('#head-model-input').val() != '' && $('#head-brand-input').val() != '' && headId != 0 ){
                if($('#head_id_'+headId).length == 0){
                    $head = '<div id="head_id_'+headId+'">' +
                            '<input type="button" value="x" onclick="headRemove('+headId+');" /> ' +
                            $('#head-brand-input').val() + " / " + $('#head-model-input').val() +
                            '<input type="hidden" name="Printer[headIds][]" value="'+headId+'" />' +
                        '</div>';
                    $('#heads').append($head);

                }
                headId = 0;
                $('#head-model-input').val('');
                $('#head-brand-input').val('');
                $('.suggestions').val('');
                $('#head-brand-input').focus();
            }
        });
    })
</script>

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
