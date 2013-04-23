<?php
$this->breadcrumbs=array(
	'Список красок'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список Красок','url'=>array('index')),
);
?>

<h2>Добавить Краску</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>