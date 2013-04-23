<?php

$this->menu=array(
	array('label'=>'Список головок','url'=>array('index')),
	array('label'=>'Добавить головку','url'=>array('create')),
);
?>

<h2>Головки</h2>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'head-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'brand',
		'model',
		'class',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template' => '{update} {delete}'
		),
	),
)); ?>
