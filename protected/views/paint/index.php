<?php

$this->menu=array(
	array('label'=>'Список красок','url'=>array('index')),
	array('label'=>'Добавить краску','url'=>array('create')),
);
?>

<h2>Краски</h2>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'paint-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'brand',
		'class',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template' => '{view} {update} {delete}'
		),
	),
)); ?>
