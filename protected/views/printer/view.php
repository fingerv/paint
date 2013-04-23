<?php
$this->breadcrumbs=array(
	'Printers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Printer','url'=>array('index')),
	array('label'=>'Create Printer','url'=>array('create')),
	array('label'=>'Update Printer','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Printer','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Printer','url'=>array('admin')),
);
?>

<h1>View Printer #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'brand',
		'model',
		'scheme',
		'logo',
	),
)); ?>
