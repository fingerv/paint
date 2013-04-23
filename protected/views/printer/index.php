<?php
$this->menu=array(
	array('label'=>'Список принтеров','url'=>array('index')),
	array('label'=>'Создать принтер','url'=>array('create')),
);
?>

<h2>Принтеры</h2>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'printer-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'brand',
		'model',
		'scheme',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template' => '{update} {delete}'
		),
	),
)); ?>
